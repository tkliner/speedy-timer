<?php declare(strict_types=1);

/**
 * This file is part of the Speedy Components (http://stagemedia.cz)
 * Copyright (c) 2016 Tomáš Kliner
 */

namespace Speedy\Timer;

/**
 * Class Timer
 * @package     Speedy\Timer
 * @author      Tomáš Kliner <kliner.tomas@gmail.com>
 * @since       1.0.0
 */
class Timer
{
    /** base name for item */
    const BASE_ITEM = '__base__';

    /** @var array */
    protected $items = [];

    /** @var array */
    protected $activeItems = [];

    /**
     * Timer constructor.
     */
    public function __construct()
    {
        $this->items[self::BASE_ITEM] = new Item(self::BASE_ITEM);
    }

    /**
     * Return items array
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get item by key
     *
     * @param $key
     *
     * @return null|Item
     */
    public function getItem($key): ?Item
    {
        return $this->getItems()[$key] ?? null;
    }

    /**
     * Return if item is running
     *
     * @param $key
     *
     * @return bool
     */
    public function isRunning($key): bool
    {
        $activeItem = $this->activeItems[$key] ?? null;

        return !(null === $activeItem);
    }

    /**
     * Add new item to array and start timing on this item
     *
     * @param mixed $name
     *
     * @return self
     */
    public function start($name = null): self
    {
        if (null !== $name) {
            $this->items[$name] = clone $this->items[self::BASE_ITEM];
            $this->activeItems[$name] = $item = $this->items[$name] ?? new Item($name);
            $item->start($name);

            return $this;
        }

        $this->activeItems[self::BASE_ITEM] = $item = $this->items[self::BASE_ITEM];
        $item->start(self::BASE_ITEM);

        return $this;
    }

    /**
     * Stop timing on selected item and return instance of this item
     *
     * @param string $name
     *
     * @return Item
     * @throws \InvalidArgumentException
     */
    public function stop(?string $name = null): Item
    {
        $name = $name ?? self::BASE_ITEM;
        $item = $this->items[$name] ?? null;

        if (null !== $item) {
            unset($this->activeItems[$name]);

            return $item->stop();
        }

        throw new \InvalidArgumentException(sprintf('Item with name %s not found!', $name));
    }

}
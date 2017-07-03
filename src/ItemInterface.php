<?php declare(strict_types=1);

/**
 * This file is part of the Speedy Components (http://stagemedia.cz)
 * Copyright (c) 2016 Tomáš Kliner
 */

namespace Speedy\Timer;

/**
 * Interface ItemInterface
 * @package Speedy\Timer
 */
interface ItemInterface
{
    /**
     * Return name of item
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Start timing
     *
     * @param mixed $name
     */
    public function start($name): void;

    /**
     * Stop timing
     *
     * @return Item
     */
    public function stop(): Item;

    /**
     * Return resulting time
     *
     * @param int|null $format
     *
     * @return float
     */
    public function getTime(?int $format = null): float;
}
<?php declare(strict_types=1);

/**
 * This file is part of the Speedy Components (http://stagemedia.cz)
 * Copyright (c) 2016 Tomáš Kliner
 */

namespace Speedy\Timer;

/**
 * Class Item
 * @package     Speedy\Timer
 * @author      Tomáš Kliner <kliner.tomas@gmail.com>
 * @since       1.0.0
 */
class Item implements ItemInterface
{
    /** @var string */
    private $name;

    /** @var int */
    protected $startTime;

    /** @var int */
    protected $endTime;

    /** @var int */
    protected $memory;

    /**
     * Item constructor.
     *
     * @param mixed $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->memory = memory_get_usage(true);
    }

    /**
     * Return name of item
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Start timing
     *
     * @param mixed $name
     *
     * @return void
     */
    public function start($name): void
    {
        $this->name = $name;
        $this->startTime = microtime(true);
    }

    /**
     * Stop timing
     *
     * @return Item
     */
    public function stop(): self
    {
        $this->endTime = microtime(true);

        return $this;
    }

    /**
     * Returns the resulting time
     *
     * @param int|null $format
     *
     * @return float
     */
    public function getTime(?int $format = null): float
    {
        $result = $this->endTime - $this->startTime;

        return $this->formatTime($result, $format);
    }

    /**
     * Returns the resulting raw time in microseconds
     *
     * @return float
     */
    public function getRawTime(): float
    {
        return $this->endTime - $this->startTime;
    }

    /**
     * Return memory usage
     *
     * @return string
     */
    public function getMemory(): string
    {
        return $this->formatMemory($this->memory);
    }

    /**
     * Format time
     *
     * @param float    $time
     * @param int|null $format
     *
     * @return float
     */
    private function formatTime(float $time, ?int $format = null): float
    {
        if (null === $format) {
            return round($time * 1000, 0);
        }

        echo "ZDE";

        return $time;
    }

    /**
     * Format memory to MB unit
     *
     * @param int $memory
     *
     * @return string
     */
    private function formatMemory(int $memory): string
    {
        return sprintf('%s MB', $memory / 1024 / 1024);
    }

}
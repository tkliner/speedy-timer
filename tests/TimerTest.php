<?php declare(strict_types=1);

/**
 * This file is part of the Speedy Components (http://stagemedia.cz)
 * Copyright (c) 2016 Tomáš Kliner
 */

namespace Speedy\Timer\Test;

use PHPUnit\Framework\TestCase;
use Speedy\Timer\Item;
use Speedy\Timer\Timer;

/**
 * Class TimerTest
 * @author      Tomáš Kliner <kliner.tomas@gmail.com>
 * @since       1.0.0
 */
class TimerTest extends TestCase
{
    const SLEEP_TIME = 10;

    public function testStart()
    {
        $timer = new Timer;
        $timer->start('test');

        $this->assertInstanceOf(
            Timer::class,
            $timer,
            'Timer isn\'t instance of ' . Timer::class
        );

        $this->assertInstanceOf(
            Item::class,
            $timer->getItem('test'),
            'Item isn\'t instance of ' . Timer::class
        );
    }

    public function testBaseItem()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start();

        $items = $timer->getItems();

        $this->assertArrayHasKey(\Speedy\Timer\Timer::BASE_ITEM, $items, 'Base item was not created');
    }

    public function testIsRunning()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start('test');

        $this->assertTrue($timer->isRunning('test'), 'Test item isn\'t running');
    }

    public function testIsBaseRunning()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start();

        $this->assertTrue($timer->isRunning(\Speedy\Timer\Timer::BASE_ITEM), 'Base item isn\'t running');
    }

    public function testGetItems()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start('test');

        $this->assertCount(2, $timer->getItems(), 'Number of returned items is not same as excepted count');
    }

    public function testGetItem()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start('test');
        $item = $timer->getItem('test');

        $this->assertSame('test', $item->getName(), 'Item test isn\'t exist');
    }

    public function testStop()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->start('test');
        usleep(100000);
        $item = $timer->stop('test');

        $this->assertEquals(100, $item->getTime(), null, self::SLEEP_TIME);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithoutStart()
    {
        $timer = new \Speedy\Timer\Timer;
        $timer->stop('test');
    }

}
<?php declare(strict_types=1);

/**
 * This file is part of the Speedy Components (http://stagemedia.cz)
 * Copyright (c) 2016 Tomáš Kliner
 */

use Speedy\Timer\Timer;

if (!function_exists('timer')) {
    function timer()
    {
        return new Timer();
    }
}
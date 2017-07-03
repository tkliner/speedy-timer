[![Build Status](https://travis-ci.org/tkliner/speedy-timer.svg?branch=master)](https://travis-ci.org/tkliner/speedy-timer)

# Speedy Timer

Speedy Timer is a package component for script runtime measurement that may be used for debugging applications within 
system development.

## Requirements

- \>= php 7.1

## Installation

```sh
$ composer require speedy/timer
```

## Usage

Basic usage for activating the measurement of the runtime script:

```php

require_once __DIR__ . '/vendor/autoload.php';

use Speedy\Timer\Timer;

$timer = new Timer();
$timer->start();
// some code
$item = $timer->stop();

var_dump($item->getTime()); // show run-time in milliseconds
var_dump($item->getTime(true)); // show run-time in microseconds
```

You can use shortcut to create the Timer class instance:

```php

require_once __DIR__ . '/vendor/autoload.php';

$timer = timer()->start();
//some code
$item = $timer->stop();

var_dump($item->getTime());

```

To track the duration of different parts of the script it is possible to name each item in the following way:


```php

require_once __DIR__ . '/vendor/autoload.php';

$timer = timer()->start('test1');
//some code
$timer = timer()->start('test2');
//some code
$item = $timer->stop('test1);
var_dump($item->getTime());
//some code
$item2 = $timer->stop('test2);
var_dump($item2->getTime())

```

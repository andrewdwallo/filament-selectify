<?php

namespace Wallo\FilamentSelectify\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Wallo\FilamentSelectify\FilamentSelectifyServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentSelectifyServiceProvider::class,
        ];
    }
}

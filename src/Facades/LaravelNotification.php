<?php

namespace Nrox\LaravelNotification\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nrox\LaravelNotification\LaravelNotification
 */
class LaravelNotification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nrox\LaravelNotification\LaravelNotification::class;
    }
}

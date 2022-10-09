<?php

namespace StarfolkSoftware\Gauge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Gauge\Gauge
 */
class Gauge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \StarfolkSoftware\Gauge\Gauge::class;
    }
}

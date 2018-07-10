<?php

namespace Subdesign\LaravelWebfaction\Facades;

use Illuminate\Support\Facades\Facade;

class Webfaction extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'webfaction';
    }
}
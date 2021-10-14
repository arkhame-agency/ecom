<?php

namespace Modules\Noviship\Facades;

use Illuminate\Support\Facades\Facade;

class NovishipFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Noviship';
    }

}

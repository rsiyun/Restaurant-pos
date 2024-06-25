<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SessionService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\SessionService::class;
    }
}

?>

<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Ssdb extends Facade
{
    protected static function getFacadeAccessor() {
             return 'ssdb.simple'; 
    }
}
<?php

use PHPtricks\Logaty\App;
use PHPtricks\Logaty\ILogatyService;
use PHPtricks\Logaty\Logaty;

if(!function_exists('logaty')) {
    function logaty() : ILogatyService
    {
        return Logaty::up()->get(App::class);
    }
}
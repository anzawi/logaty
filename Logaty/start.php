<?php

use PHPtricks\Logaty\App;
use PHPtricks\Logaty\Logaty;

if(!function_exists('logaty')) {
    function logaty() : App
    {
        return Logaty::up()->get(App::class);
    }
}
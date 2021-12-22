<?php

use PHPtricks\Logaty\App;

if(!function_exists('logaty')) {
    function logaty() : App
    {
        return App::init();
    }
}
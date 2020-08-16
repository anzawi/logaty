<?php
require_once ('vendor/autoload.php');

use PHPtricks\Logaty\App;

global $logaty;

$logaty = new App();


if(!function_exists('logaty'))
{
    function logaty($string = '', $lang = '')
    {
        global $logaty;

        if($string || $lang)
            return $logaty($string, $lang);

        return $logaty;
    }
}

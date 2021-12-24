<?php

namespace PHPtricks\Logaty\Helpers;

class Detect
{
    public function browser()
    {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
}
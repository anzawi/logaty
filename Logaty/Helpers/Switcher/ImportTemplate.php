<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait ImportTemplate
{
    protected function render($template, $id)
    {
        $separator = DIRECTORY_SEPARATOR;
        $path = logaty()->rootDir() . "assets{$separator}switch-templates{$separator}{$template}.php";

        if (file_exists($path))
            include $path;
    }
}
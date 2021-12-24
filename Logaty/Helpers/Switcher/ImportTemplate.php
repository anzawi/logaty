<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait ImportTemplate
{
    /**
     * @param $template
     * @return void
     */
    protected function render($template) : void
    {
        $separator = DIRECTORY_SEPARATOR;
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . "assets{$separator}switch-templates{$separator}{$template}.php";

        if (file_exists($path))
            include $path;
    }
}
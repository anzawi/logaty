<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait Select
{
    public function select(): void
    {
        $this->render('select');
    }
}
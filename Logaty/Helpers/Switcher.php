<?php
namespace PHPtricks\Logaty\Helpers;

use PHPtricks\Logaty\Helpers\Switcher\Select;
use PHPtricks\Logaty\Helpers\Switcher\Ul;
use PHPtricks\Logaty\Helpers\Switcher\ImportTemplate;

class Switcher
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
	use Select;
	use Ul;
	use ImportTemplate;
}
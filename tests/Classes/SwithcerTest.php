<?php

namespace PHPtricks\Logaty\Tests\Classes;

use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\Helpers\Switcher;
use PHPUnit\Framework\TestCase;

class SwithcerTest extends TestCase
{
    public function testGenerateUlLanguageSwitch()
    {
        $this->assertFileExists('./assets/switch-templates/ul.php');
    }

    public function testGenerateDropDownListLanguageSwitch()
    {
        $this->assertFileExists('./assets/switch-templates/select.php');
    }
}

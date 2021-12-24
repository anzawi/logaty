<?php

namespace PHPtricks\Logaty\Tests\Classes;

use PHPtricks\Logaty\Helpers\Detect;
use PHPUnit\Framework\TestCase;

class DetectTest extends TestCase
{

    public function testDetectBrowserLanguage()
    {
        $detect = new Detect();
        $language = $detect->browser();
        $this->assertEquals('ar', $language);
    }
}

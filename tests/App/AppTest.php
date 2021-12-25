<?php

namespace PHPtricks\Logaty\Tests\App;

use PHPtricks\Logaty\App;
use PHPtricks\Logaty\Helpers\Config;
use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\Helpers\Link;
use PHPtricks\Logaty\Helpers\Switcher;
use PHPtricks\Logaty\Translate\Translator;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testLogatyFunctionIsAppObject()
    {
        $this->assertInstanceOf(App::class, logaty());
    }

    public function testConfig()
    {
        $this->assertInstanceOf(Config::class, logaty()->config());
    }

    public function testSwitcher()
    {
        $this->assertInstanceOf(Switcher::class, logaty()->switcher());
    }

    public function testLink()
    {
        $this->assertInstanceOf(Link::class, logaty()->link());
    }

    public function testTranslator()
    {
        $this->assertInstanceOf(Translator::class, logaty()->translator());
    }

    public function testDetector()
    {
        $this->assertInstanceOf(Detect::class, logaty()->detector());
    }

    public function testIfWeCanCallInstanceMethodAsProperty()
    {
        $this->assertInstanceOf(Config::class, logaty()->config);
        $this->assertInstanceOf(Switcher::class, logaty()->switcher);
        $this->assertInstanceOf(Link::class, logaty()->link);
        $this->assertInstanceOf(Translator::class, logaty()->translator);
    }

    public function testGetEnabledLanguages()
    {
        $this->assertIsArray(logaty()->enabled());
        $this->assertIsArray(logaty()->enabled);
    }


    public function testCheckIfLanguageIsEnabled()
    {
        $this->assertIsBool(logaty()->isEnabled('en'));
    }

    public function testIfWeCanGetOption()
    {
        $this->assertIsString(logaty()->option('default_lang'));
    }

    public function testFlagsList()
    {
        $this->assertIsArray(logaty()->flags());
        $this->assertIsArray(logaty()->flags());
    }

    public function testGetLanguageFlag()
    {
        $this->assertIsString(logaty()->flag('en'));
    }


    public function test_xMethodToGetTranslation()
    {
        $this->assertIsString(logaty()->_x('home.test'));
    }


    public function testGetNaturalNameOfLanguageByCode()
    {
        $this->assertIsString(logaty()->naturalName('en'));
    }

    public function testGetNameOfLanguageByCode()
    {
        $this->assertIsString(logaty()->name('en'));
    }


    public function testAllLanguagesDirections()
    {
        $this->assertIsArray(logaty()->directions());
        $this->assertIsArray(logaty()->directions);
    }

    public function testGetLanguageDirection()
    {
        $this->assertIsString(logaty()->direction('en'));
    }

    public function testGetSelectedLanguage()
    {
        $this->assertIsString(logaty()->current());
        $this->assertIsString(logaty()->current);
    }

    public function testGetDefaultLanguage()
    {
        $this->assertIsString(logaty()->default());
        $this->assertIsString(logaty()->default);
    }
}

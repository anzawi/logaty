<?php

namespace PHPtricks\Logaty\Tests\Classes;

use PHPtricks\Logaty\Translate\Translator;
use PHPUnit\Framework\TestCase;

class TranslatorTest extends TestCase
{
    protected $translator;
    public function setUp(): void
    {
        $this->translator = new Translator();
        parent::setUp();
    }

    public function testGetTranslateWithSelectedLanguage()
    {
        $string = $this->translator->getTranslate('home.test');
        $this->assertStringContainsString($string, 'Test String');
    }

    public function testGetTranslateWithGivenLanguage()
    {
        $string = $this->translator->getTranslate('home.test', 'ar');
        $this->assertStringContainsString($string, 'نص تجريبي');
    }

    public function testGetTranslateWithNotSupportedGivenLanguage()
    {
        $string = $this->translator->getTranslate('home.test', 'language-code');
        $this->assertStringContainsString($string, 'Test String');
    }

    public function testGetTranslateForNotExistsTranslation()
    {
        $string = $this->translator->getTranslate('file.key');
        $this->assertEquals('file.key', $string);
    }

    public function testGetTranslateForNotExistsTranslationWithGivenLanguage()
    {
        $string = $this->translator->getTranslate('file.key');
        $this->assertEquals('file.key', $string);
    }

    public function testGetTranslateForNotExistsTranslationWithNotSupportedGivenLanguage()
    {
        $string = $this->translator->getTranslate('file.key', 'not-supported-language');
        $this->assertEquals('file.key', $string);
    }

    public  function tearDown(): void
    {
        $this->translator = null;
        parent::tearDown();
    }
}

<?php

use PHPtricks\Logaty\App;
use PHPUnit\Framework\TestCase;

class TranslatorTest extends TestCase
{

    protected $_defaultLanguage;
    protected $_currentLanguage;

    protected function setUp() : void
    {
        $this->_defaultLanguage = logaty()->defaultLang();
        $this->_currentLanguage = logaty()->current();
        if ($this->_currentLanguage === $this->_defaultLanguage)
            $this->_currentLanguage = 'ar';
    }

    /** @test */
    public function logaty_is_instance_of_app_class()
    {
        $this->assertInstanceOf(App::class, logaty());
    }

    /** @test */
    public function we_can_translate_string_to_current_language()
    {
        $translate = logaty('home.test', $this->_currentLanguage);

        $this->assertEquals($translate,'نص تجريبي');
    }

    /** @test */
    public function we_can_translate_string_to_default_language()
    {
        $translate = logaty('home.test', $this->_defaultLanguage);

        $this->assertEquals($translate,'Test String');
    }

    /** @test */
    public function we_can_translate_string_with__x_method()
    {
        $translate = logaty()->_x('home.test');

        $this->assertIsString($translate,'Test String');
    }

    /** @test */
    public function if_we_send_unexists_translate_returns_same_sent_string()
    {
        $translate = logaty('file.not-exists');

        $this->assertEquals($translate,'file.not-exists');
    }

    /** @test */
    public function we_can_translate_string_with_specified_language()
    {
        $translate = logaty('file.not-exists', 'ru');

        $this->assertIsString($translate);
    }
}

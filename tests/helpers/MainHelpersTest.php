<?php

namespace helpers;

use PHPtricks\Logaty\Helpers\Config;
use PHPUnit\Framework\TestCase;

class MainHelpersTest extends TestCase
{
    /** @test */
    public function config_property_is_instance_of_config_class()
    {
        $this->assertInstanceOf(Config::class, logaty()->config);
    }

    /** @test */
    public function send_wrong_config_key_or_path_to_config_helper_well_return_null()
    {
        $this->assertNull(logaty()->config('wrong.key'));
    }

    /** @test */
    public function we_can_get_default_language_for_our_website()
    {
        $this->assertEquals('en', logaty()->defaultLang());
    }

    /** @test */
    public function we_can_get_current_language_for_our_website()
    {
        $this->assertEquals('en', logaty()->current());
    }
    /** @test */
    public function we_can_get_logaty_options()
    {
        $this->assertIsBool(logaty()->options('detect_country_lang'));
    }

    /** @test */
    public function we_can_check_if_language_is_enabled_or_not()
    {
        $this->assertIsBool(logaty()->enabled('ar'));
    }

    /** @test */
    public function we_can_get_all_enabled_languages()
    {
        $this->assertIsArray(logaty()->enabled());
    }

    /** @test */
    public function we_can_get_language_flag()
    {
        $this->assertIsString(logaty()->flag('ar'));
    }

    /** @test */
    public function we_can_get_all_languages_flags()
    {
        $this->assertIsArray(logaty()->flag());
    }

    /** @test */
    public function we_can_get_language_direction()
    {
        $this->assertIsString(logaty()->direction('ar'));
    }

    /** @test */
    public function we_can_get_all_languages_directions()
    {
        $this->assertIsArray(logaty()->direction());
    }

    /** @test */
    public function we_can_get_language_name_in_english()
    {
        $this->assertIsString(logaty()->name('ar'));
    }

    /** @test */
    public function we_can_get_language_name_in_natural_language()
    {
        $this->assertIsString(logaty()->nameN('ar'));
    }
}

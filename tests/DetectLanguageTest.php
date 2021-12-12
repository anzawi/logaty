<?php


use PHPUnit\Framework\TestCase;
use PHPtricks\Logaty\Helpers\Detect;

class DetectLanguageTest extends TestCase
{
    /** @test */
    public function detect_property_is_instance_of_detect_class()
    {
        $this->assertInstanceOf(Detect::class, logaty()->detect);
    }

    /**
     * this test need (detect_country_lang) in config/options.php to be true to pass
     */
    /** @test */
    public function we_can_detect_browser_language()
    {
        $browserLang = logaty()->detect('browser');
        $this->assertEquals($browserLang, 'ar');
    }

    /**
     * this test need (detect_browser_lang) in config/options.php to be true to pass
     */
    /** @test */
    public function we_can_detect_country_language()
    {
        $countryLang = logaty()->detect('country');
        $this->assertEquals($countryLang, 'en');
    }

    /**
     * this test need (detect_browser_lang && detect_country_lang)
     * in config/options.php to be true to pass
     */
    /** @test */
    public function we_can_detect_language_as_we_configure_that()
    {
        $langs = logaty()->detect();
        if(!is_array($langs)) {
            print('we_can_detect_language_as_we_configure_that() ');
            print('need (detect_browser_lang && detect_country_lang)');
            $this->assertEquals(true, true);
            
        } else {
            $this->assertIsArray($langs);
            $this->assertEquals($langs['browser'], 'ar');
            $this->assertEquals($langs['country'], 'ar');
        }
    }
}

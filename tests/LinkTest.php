<?php


use PHPUnit\Framework\TestCase;
use PHPtricks\Logaty\Helpers\Link;

class LinkTest extends TestCase
{
    // /** @test */
    // public function link_property_is_instance_of_link_class()
    // {
    //     $this->assertInstanceOf(Link::class, logaty()->link);
    // }

    // /** @test */
    // public function we_can_generate_link()
    // {
    //     $link = logaty()->link('uri');
    //     $this->assertMatchesRegularExpression('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link);
    // }

    // /** @test */
    // public function we_can_generate_link_to_custom_uri_with_current_language()
    // {
    //     $link = logaty()->link('page/we/need');
    //     $this->assertMatchesRegularExpression('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link);
    //     $this->assertStringContainsString(
    //         logaty()->options('page/we/need') .
    //         '=' . logaty()->defaultLang(),
    //         $link
    //     );
    // }

    // /** @test */
    // public function we_can_generate_link_to_custom_uri_with_specified_language()
    // {
    //     $link = logaty()->link('page/we/need', logaty()->defaultLang());
    //     $this->assertMatchesRegularExpression('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link);
    //     $this->assertStringContainsString(
    //         logaty()->options('page/we/need') .
    //         '=' . logaty()->defaultLang(),
    //         $link
    //     );
    //     $this->assertStringContainsString(
    //         logaty()->options('lang_key') .
    //         '=' . logaty()->defaultLang(),
    //         $link
    //     );
    // }

    // /** @test */
    // public function we_can_generate_link_to_current_uri_with_specified_language()
    // {
    //     $link = logaty()->link('', logaty()->defaultLang());
    //     $this->assertMatchesRegularExpression('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link);
    //     $this->assertStringContainsString(
    //         logaty()->options('lang_key') .
    //         '=' . logaty()->defaultLang(),
    //         $link
    //     );
    // }

    // /**
    //  * this test need (hide_default_language) in config/options.php to be false to pass
    //  */
    // /** @test */
    // public function we_can_generate_link_to_current_uri_with_current_language()
    // {
    //     $link = logaty()->link();
    //     $this->assertMatchesRegularExpression('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link);
    //     $this->assertStringContainsString('home', $link);
    // }
}

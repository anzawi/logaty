<?php

namespace PHPtricks\Logaty\Tests\Classes;

use PHPtricks\Logaty\Helpers\Link;
use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase
{
    protected $link;
    protected $urlPattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
    public function setUp(): void
    {
        $this->link = new Link();
        parent::setUp();
    }

    public function testCreateLinkToSamePageWithSelectedLanguage()
    {
        $link = $this->link->create();
        $this->assertMatchesRegularExpression($this->urlPattern, $link);
    }

    public function testCreateLinkToOtherPageWithSelectedLanguage()
    {
        $link = $this->link->create('page/we/want');
        $this->assertMatchesRegularExpression($this->urlPattern, $link);
        $this->assertStringContainsString('/page/we/want', $link);
    }

    public function testCreateLinkToSamePageWithGivenLanguage()
    {
        $link = $this->link->create('', 'ar');
        $this->assertMatchesRegularExpression($this->urlPattern, $link);
        $this->assertStringContainsString('http://logaty.dev/home', $link);
        $this->assertStringEndsWith('?lang=ar', $link);
    }

    public function testCreateLinkToOtherPageWithGivenLanguage()
    {
        $link = $this->link->create('page/we/want', 'ar');
        $this->assertMatchesRegularExpression($this->urlPattern, $link);
        $this->assertStringContainsString('/page/we/want', $link);
        $this->assertStringEndsWith('?lang=ar', $link);
    }


    public function testCreateLinkMethodCanReBuildQueryString()
    {
        $uri = '/some/page/we/in?param=string&otherParam=value&other=other';
        $link = $this->link->create($uri);
        $this->assertMatchesRegularExpression($this->urlPattern, $link);
        $this->assertStringContainsString('/some/page/we/in', $link);
        $this->assertStringContainsString('param=string&otherParam=value&other=other', $link);
        $this->assertStringEndsWith('&lang=en', $link);
    }

    public  function tearDown(): void
    {
        $this->link = null;
        parent::tearDown();
    }
}

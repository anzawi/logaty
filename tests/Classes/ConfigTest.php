<?php

namespace PHPtricks\Logaty\Tests\Classes;

use PHPtricks\Logaty\Helpers\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    protected $config;

    public function setUp(): void
    {
        $this->config = new Config();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testGet()
    {
        $this->assertIsArray($this->config->get('code'));
        $this->assertIsArray($this->config->get('direction'));
        $this->assertIsArray($this->config->get('enabled'));
        $this->assertIsArray($this->config->get('flags'));
        $this->assertIsArray($this->config->get('name'));
        $this->assertIsArray($this->config->get('options'));
        $this->assertIsArray($this->config->get('paths'));
    }

    public function testGetSingle()
    {
        $this->assertIsString($this->config->get('code.en'));
        $this->assertIsString($this->config->get('direction.en'));
        $this->assertIsString($this->config->get('flags.en'));
        $this->assertIsString($this->config->get('name.english.en'));
        $this->assertIsString($this->config->get('options.default_lang'));
        $this->assertIsString($this->config->get('paths.lang_files'));
    }

    public function tearDown(): void
    {
        $this->config = null;
        parent::tearDown();
    }
}

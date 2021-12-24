<?php

namespace PHPtricks\Logaty;

use PHPtricks\Logaty\Helpers\Config;
use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\Helpers\Link;
use PHPtricks\Logaty\Helpers\Switcher;
use PHPtricks\Logaty\Translate\Translator;

interface ILogatyService
{
    /**
     * if we call a method like a property
     * we need to call a method correctly
     * @param $property
     * @return mixed|null
     */
    public function __get(string $method);

    /**
     * get instance of Link::class
     * to generate links with correct language
     * @uses logaty()->link->create($uri = '', $language = '');
     */
    public function link() : Link;
    /**
     * get config value from config files
     * @return Config
     *
     * @uses   logaty()->config; // return instance of Config class
     * @uses   logaty()->config(); // return instance of Config class
     * @uses   logaty()->config->get($config_path); // return config value
     */
    public function config(): Config;
    /**
     * get instance of Translator::class
     */
    public function translator(): Translator;
    /**
     * get instance of Switcher::class
     */
    public function switcher(): Switcher;
    /**
     * get instance of Detect::class
     */
    public function detector(): Detect;

    /**
     *check if specified language is enabled
     * @param string $lang
     * @return bool
     *
     * @uses logaty()->isEnabled(language-code);
     *      return (bool) true if language enabled false if not
     */
    public function isEnabled(string $language) : bool;
    /**
     * get all enabled languages OR check if specified language is enabled
     * @return array
     *
     * @uses logaty()->enabled(); return (array) all enabled languages
     * @uses logaty()->enabled; return (array) all enabled languages
     */
    public function enabled(): array;

    public function current(): string;
    public function default(): string;

     /**
     * get config value from Config/options.php file.
     * @param $option
     * @return mixed
     *
     * @uses logaty()->option(option-name);
     */
    public function option(string $option): mixed;

    /**
     * get flag for givane language
     * @param string $language
     * @return string
     *
     * @uses logaty()->flag(language-Code); // return flag for -language-Code- language
     */
    public function flag(string $language): string;
    /**
     * get all flags
     * @return array
     *
     * @uses logaty()->flags(); // return (array) all flags
     *       logaty()->flags; // return (array) all flags
     */
    public function flags(): array;
    /**
     * get language direction (RTL, LTR)
     * @param string $language
     * @return string
     *
     * @uses logaty()->direction(language-Code); // return direction for -language-Code- language
     */
    public function direction(string $language): string;
    /**
     * all get language directions
     * @return array
     *
     * @uses logaty()->directions()
     * @uses logaty()->directions
     */
    public function directions(): array;

    /**
     * get language Name in English
     * @param string $language
     * @return string
     *
     * @uses logaty()->name(language-Code); // return name for -language-Code- language
     */
    public function name(string $language): string;
    /**
     * get language Name in native language
     * @param string $language
     * @return string
     *
     * @uses logaty()->naturalName(language-Code); // return name for -language-Code- language
     */
    public function naturalName(string $language): string;
    /**
     * Get Path
     * @param $path
     * @return mixed
     */
    public function path(string $pathKey): string;

    /**
     * get translation
     * @param string $key
     * @param string $language (optinal)
     */
    public function _x(string $key, string $language = ''): string;
    /**
     * echo translation
     * @param string $key
     * @param string $language (optinal)
     */
    public function __(string $key, string $language = ''): void;
}
<?php


namespace PHPtricks\Logaty;

use PHPtricks\Logaty\Helpers\Link;
use PHPtricks\Logaty\Helpers\Config;
use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\ILogatyService;
use PHPtricks\Logaty\Helpers\Switcher;
use PHPtricks\Logaty\Translate\Translator;
use PHPtricks\Logaty\Exceptions\FlagNotImplementException;
use PHPtricks\Logaty\Exceptions\NameNotImplementException;
use PHPtricks\Logaty\Exceptions\DirectionNotImplementException;

class App implements ILogatyService
{
    public function __construct(
        Config $config,
        Link $link,
        Detect $detect,
        Translator $trans,
        Switcher  $switcher
    ) {
        $this->config = $config;
        $this->link = $link;
        $this->detect = $detect;
        $this->trans = $trans;
        $this->switcher = $switcher;
    }

    public function __get(string $method)
    {
        return $this->$method();
    }

    public function link(): Link
    {
        return $this->link;
    }
    public function config(): Config
    {
        return $this->config;
    }
    public function translator(): Translator
    {
        return $this->trans;
    }
    public function switcher(): Switcher
    {
        return $this->switcher;
    }
    public function detector(): Detect
    {
        return $this->detect;
    }

    public function isEnabled(string $language): bool
    {
        return in_array($language, $this->enabled());
    }
    public function enabled(): array
    {
        return $this->config->get('enabled');
    }

    public function current(): string
    {
        $parameter = $this->option('lang_key');
        if (isset($_GET[$parameter]))
        {
            if ($this->isEnabled(strtolower($_GET[$parameter])))
            {
                return strtolower($_GET[$parameter]);
            }
        }

        return $this->default();
    }
    public function default(): string
    {
        return $this->option('default_lang');
    }

    public function option(string $option)
    {
        $option = $this->config->get("options.{$option}");
        return $option;
    }

    public function flag(string $language): string
    {
        if(isset($this->flags[$language])) {
            return $this->flags[$language];
        }

        throw new FlagNotImplementException($language);
    }
    public function flags(): array
    {
        return $this->config->get("flags");
    }

    public function direction(string $language): string
    {
        if(isset($this->directions[$language])) {
            return $this->directions[$language];
        }

        throw new DirectionNotImplementException($language);
    }
    public function directions(): array
    {
        return $this->config->get("direction");
    }

    public function name(string $language): string
    { 
        if(isset($this->config->get("name.english")[$language])) {
            return $this->config->get("name.english")[$language];
        }
        
        throw new NameNotImplementException($language);
    }
    public function naturalName(string $language): string
    { 
        if(isset($this->config->get("name.natural")[$language])) {
            return $this->config->get("name.natural")[$language];
        }
        
        throw new NameNotImplementException($language);
    }

    public function path(string $pathKey): string
    {
        return $this->config->get("paths.$pathKey");
    }

    public function _x(string $key, string $language = ''): string
    {
        return $this->translator->getTranslate($key, $language);
    }
    public function __(string $key, string $language = ''): void
    {
        echo $this->_x($key, $language);
    }
}

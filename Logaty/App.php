<?php


namespace PHPtricks\Logaty;


use PHPtricks\Logaty\Helpers\Config;
use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\Helpers\Link;
use PHPtricks\Logaty\Helpers\Switcher;
use PHPtricks\Logaty\Translate\Translator;

class App
{

    private static $_instance = null;

    private function __construct(
        Config $config,
        Link $link,
        Detect $detect,
        Translator $trans,
        Switcher  $switcher
    )
    {
        $this-> config = $config;
        $this-> link = $link;
        $this-> detect = $detect;
        $this-> trans = $trans;
        $this-> switcher = $switcher;
    }

    public static function init()
    {
        if(static::$_instance === null) {
            static::$_instance = Logaty::get(App::class);
        }

        return static::$_instance;
    }

    /**
     * to use object as function
     * @param $string
     * @param string $lang
     * @return string
     *
     * @uses logaty(STRING, LANG-CODE);
     */
    public function __invoke($string, $lang = '')
    {
        return $this->_x($string, $lang);
    }


    /**
     * if we call a method like a property
     * we need to call a method correctly
     * @param $property
     * @return mixed|null
     */
    public function __get($property)
    {
        if(method_exists($this, $property))
		{
			if($property == 'default')
				return $this->defaultLang();
			
			return $this->$property();
		}
				
        // we will throw new exception
        return null;
    }


    /**
     * get root directory for our Library
     * @return string
     */
    public function rootDir()
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR;
    }

    /**
     * get config value from config files
     * @param string $path
     * @return mixed|Config|null
     *
     * @uses   logaty()->config(file-name.config-name); // return value for key
     * @uses   logaty()->config(); // return all configurations
     */
    public function config($path = '')
    {
        return (
        $path ?
            $this->config->get($path) :
            $this->config->get()
        );
    }

    /**
     * get config value from Config/options.php file.
     * @param $optionName
     * @return string|null
     *
     * @uses logaty()->options(option-name);
     */
    public function options($optionName)
    {
        $option = $this->config("options.{$optionName}");
        return (!is_array($option) ? $option : null);
    }

    /**
     * get all enabled languages OR check if specified language is enabled
     * @param string $lang
     * @return string|bool
     *
     * @uses logaty()->enabled(); return (array) all enabled languages
     * @uses logaty()->enabled(language-code);
     *      return (bool) true if language enabled false if not
     */
    public function enabled($lang = '')
    {
        $enabledLanguages = $this->config('enabled');

        return (
        !$lang ?
            $enabledLanguages :
            in_array($lang, $enabledLanguages)
        );
    }

    /**
     * get flags
     * @param string $lang
     * @return string|array|null
     *
     * @uses logaty()->flag(); // return (array) all flags
     *       logaty()->flag(language-Code); // return flag for -language-Code- language
     *       return null if language code is undefined
     */
    public function flag($lang = '')
    {
        $flags = $this->config("flag");

        return ($lang ? @$flags[$lang] : $flags);
    }

    /**
     * get language direction (RTL, LTR)
     * @param string $lang
     * @return string|array|null
     *
     * @uses logaty()->direction(); // return (array) all directions
     *       logaty()->direction(language-Code); // return direction for -language-Code- language
     *       return null if language code is undefined
     */
    public function direction($lang = '')
    {
        $directions = $this->config("direction");

        return ($lang ? @$directions[$lang] : $directions);
    }

    /**
     * get language Name in English
     * @param string $lang
     * @return string|array|null
     *
     * @uses logaty()->name(); // return (array) all languages name
     *       logaty()->name(language-Code); // return name for -language-Code- language
     *       return null if language code is undefined
     */
    public function name($lang = '')
    {
        $names = $this->config("name.english");

        return ($lang ? @$names[$lang] : $names);
    }

    /**
     * get language Name in Natural Language
     * @param string $lang
     * @return string|array|null
     *
     * @uses logaty()->nameN(); // return (array) all languages name
     *       logaty()->nameN(language-Code); // return name for -language-Code- language
     *       return null if language code is undefined
     */
    public function nameN($lang = '')
    {
        $names = $this->config("name.natural");

        return ($lang ? @$names[$lang] : $names);
    }

    /**
     * Get Path
     * @param $path
     * @return mixed
     */
    public function path($path)
    {
        return $this->config('paths')[$path];
    }

    /**
     * return default Language
     */
    public function defaultLang()
    {
        return $this->options('default_lang');
    }

    public function current()
    {
        $parameter = $this->options('lang_key');
        if (isset($_GET[$parameter]))
        {
            if ($this->enabled(strtolower($_GET[$parameter])))
            {
                return strtolower($_GET[$parameter]);
            }
        }

        return $this->defaultLang();
    }

    /**
     * generate link
     * @param string $url
     * @param string $lang
     * @return string
     */
    public function link($url = '', $lang = '')
    {
        return $this->link->create($url, $lang);
    }

    /**
     * get translation
     * @param $string
     * @param string $lang
     */
    public function _x($string, $lang = '')
    {
        return $this->trans->getTranslate($string, $lang);
    }

    /**
     * print translation direct
     * @param $string
     * @param string $lang
     */
    public function __($string, $lang = '')
    {
        echo $this->_x($string, $lang);
    }

    public function detect($type = '')
    {
        $detectedLanguage = $this->defaultLang();
        $detect = $this->detect;
        if (!$type)
        {
            if (
                $this->options('detect_browser_lang')
                &&
                $this->options('detect_country_lang')
            )
            {
                $detectedLanguage['browser'] = $detect->browser();
                $detectedLanguage['country'] = $detect->country();
            } else if ($this->options('detect_browser_lang'))
            {
                $detectedLanguage = $detect->browser();
            } else if ($this->options('detect_country_lang'))
            {
                $detectedLanguage = $detect->country();
            }
        } elseif ($type == "browser")
        {
            if ($this->options('detect_browser_lang'))
                $detectedLanguage = $detect->browser();
        } elseif ($type == "country")
        {
            if ($this->options('detect_country_lang'))
                $detectedLanguage = $detect->country();
        }

        return $detectedLanguage;
    }

    /*public function trans()
    {
        return $this->trans;
    }*/
}

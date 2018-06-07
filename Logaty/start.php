<?php

use PHPtricks\Logaty\App;
use PHPtricks\Logaty\Helpers\Config;
use PHPtricks\Logaty\Helpers\Link;
use PHPtricks\Logaty\Translate\Translator;
use PHPtricks\Logaty\Helpers\Detect;
use PHPtricks\Logaty\Helpers\Switcher;

global $logaty;
// create instance object of App
$logaty = new App();

// set root directory path
$logaty['rootDir'] = function () {
	return dirname(__DIR__) . DIRECTORY_SEPARATOR;
};

// set config
$logaty['config'] = function ($path = '') {
	$config = new Config();
	return ($path)
		? $config->get($path)
		: $config;
};


// set options
$logaty['options'] = function ($key) use ($logaty) {
	return (isset($logaty->config->get('options')[$key])?
        $logaty->config->get('options')[$key]
        : null);
};

// enabled language
$logaty['enabled'] = function ($lang = '') use ($logaty) {
	$enabled = $logaty->config->get('enabled');
	if( $lang ) {
		return in_array($lang, $enabled);
	}

	return $enabled;
};

// languages flags
$logaty['flag'] = function ($lang = '') use ($logaty) {
	$flags = $logaty->config->get('flag');
	if( $lang ) {
		return in_array($lang, $flags)
			? $logaty->config->get("paths.flags") . $flags[$lang]
			: $logaty->config->get("paths.flags") . 'default.png';
	}

	return array_map(function ($flag) use ($logaty) {
	    return $flag = $logaty->config->get("paths.flags") . $flag;
    }, $flags);
};
// direction of language
$logaty['direction'] = function ($lang = '') use ($logaty) {
	return ($lang)
		? $logaty->config->get('direction')[$lang]
		: $logaty->config->get('direction');
};

/**
 * get all names of supported languages or name of one language
 * @param string $lang
 * @return string|array
 */
$logaty['name'] = function ($lang = '') use ($logaty) {
	return ($lang)
		? $logaty->config->get('name.english')[$lang]
		: $logaty->config->get('name.english');
};

$logaty['nameN'] = function ($lang = '') use ($logaty) {
	return ($lang)
		? $logaty->config->get('name.natural')[$lang]
		: $logaty->config->get('name.natural');
};

/**
 * @param $path string
 * @return string
 */
$logaty['path'] = function ($path) use ($logaty) {
	return $logaty->config->get('paths')[$path];
};

/**
 * get default language
 * @return string
 */
$logaty['default'] = function () use ($logaty) {
	return $logaty->options('default_lang');
};

/**
 * get current (selected) language
 * @return null|string
 */
$logaty['current'] = function () use ($logaty) {
    $parameter = $logaty->options('lang_key');
	if( isset($_GET[$parameter]) ) {
		if( $logaty->enabled(strtolower($_GET[$parameter])) ) {
			return strtolower($_GET[$parameter]);
		}
	}

	return $logaty->default;
};

/**
 * @param string $url
 * @param string $lang
 * @return Link|string
 */
$logaty['link'] = function ($url = '', $lang ='') {
	$link = new Link();
	if( !$url && !$lang )
		return $link;

	return $link->create($url, $lang);
};

/**
 * @return Translator
 */
$logaty['trans'] = function () {
	return new Translator();
	//return $translate->getTranslate($str, $lang);
};

/**
 * @param string$str
 * @param string $lang
 */
$logaty['__'] = function ($str, $lang = '') use ($logaty) {
	echo $logaty->trans->getTranslate($str, $lang);
};

/**
 * @param string $str
 * @param string $lang
 * @return string
 */
$logaty['_x'] = function ($str, $lang = '') use ($logaty) {
	return $logaty->trans->getTranslate($str, $lang);
};

/**
 * detect user language
 * @param string $type
 * @return array|null|string
 */
$logaty['detect'] = function ($type = '') use ($logaty) {
	$detectedLanguage = null;
	$detect = new Detect();
	if( !$type ) {
		if(
			$logaty->options('detect_browser_lang')
			&&
			$logaty->options('detect_country_lang')
		) {
			$detectedLanguage['browser'] = $detect->browser();
			$detectedLanguage['country'] = $detect->country();
		}
		else if( $logaty->options('detect_browser_lang') ) {
			$detectedLanguage = $detect->browser();
		}
		else if( $logaty->options('detect_country_lang') ) {
			$detectedLanguage = $detect->country();
		}
	}
	elseif( $type == "browser" ) {
		if( $logaty->options('detect_browser_lang') )
			$detectedLanguage = $detect->browser();
	}
	elseif( $type == "country" ) {
		if( $logaty->options('detect_country_lang') )
			$detectedLanguage = $detect->country();
	}

	return $detectedLanguage;
};

/**
 * create languages switcher
 * @return Switcher
 */
$logaty['switch'] = function () {
	return new Switcher();
};
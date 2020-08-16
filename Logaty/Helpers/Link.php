<?php

namespace PHPtricks\Logaty\Helpers;
use PHPtricks\Logaty\App;

class Link
{
	public function __construct(App $app)
	{
		$this->app = $app;
	}

	public function create($link = '', $lang = '')
	{
		// if language code is not sent , so we need current language
		if(!$lang || !in_array($lang, $this->app->enabled())) $lang = $this->app->current();
		// get the language query string key
		$langKey = $this->app->options('lang_key');
		/**
		 * Build the url
		 */
		// check if (https or http)
		$url = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https://" : "http://";
		$url .= str_replace('https://', '', str_replace('http://', '', $_SERVER["SERVER_NAME"]));
		// check if server port is not (80) so we need to add port to url
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$url .= ":" . $_SERVER["SERVER_PORT"];
		}
		if(!$link)
		{
			// get the URI from current url
			$url .= $_SERVER["REQUEST_URI"];
		}
		else
		{
			$url .= "/" . trim($link, "/");
		}
		/**
		 * check and build query string
		 */
		if (strlen($_SERVER["QUERY_STRING"]) > 0 && !$link)
		{
			$url = rtrim(substr($url, 0, -strlen($_SERVER["QUERY_STRING"])), '?');
		}

		$query = $_GET;
		// remove language parameter from query string
		unset($query[$langKey]);
		// check if we have more parameters
		// and build it
		if (sizeof($query) > 0)
		{
			$url .= '?' . http_build_query($query);
			if($this->app->options('hide_default_language') && $lang == $this->app->current())
			{
				return $url;
			}
			return $url . "&{$langKey}={$lang}";
		}
		else
		{
			if($this->app->options('hide_default_language') && $lang == $this->app->defaultLang())
			{
				return $url;
			}
			else
			{
				return $url . "?{$langKey}={$lang}";
			}
		}
	}
}
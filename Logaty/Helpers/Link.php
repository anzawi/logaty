<?php

namespace PHPtricks\Logaty\Helpers;

class Link
{

	public function create($link = '', $lang = '')
	{
		// if language code is not sent , so we need current language
		if(!$lang || !logaty()->isEnabled($lang)) $lang = logaty()->current();
		// get the language query string key
		$langKey = logaty()->option('lang_key');
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
        $query = $_GET;
		if (strlen($_SERVER["QUERY_STRING"]) > 0 && !$link)
		{
			$url = rtrim(substr($url, 0, -strlen($_SERVER["QUERY_STRING"])), '?');
		} elseif (preg_match('/(.+\?)/', $link)) {
            if(logaty()->option('hide_default_language') && $lang == logaty()->current())
            {
                return $url;
            }
            return $url . "&{$langKey}={$lang}";
        }
		// remove language parameter from query string
		unset($query[$langKey]);
		// check if we have more parameters
		// and build it
		if (sizeof($query) > 0)
		{
			$url .= '?' . http_build_query($query);
			if(logaty()->option('hide_default_language') && $lang == logaty()->current())
			{
				return $url;
			}
			return $url . "&{$langKey}={$lang}";
		}
		else
		{
			if(logaty()->option('hide_default_language') && $lang == logaty()->default())
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
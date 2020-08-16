<?php

namespace PHPtricks\Logaty\Helpers\Detect;

trait Country
{
	public function country($code = '')
	{
		if(!$code) $code = $this->getCountryCodeFromIp();
		$countryInfo = logaty()->defaultLang();
		if(false !== ($countryFile = @file_get_contents("https://restcountries.eu/rest/v1/alpha/{$code}")))
			$countryInfo = json_decode($countryFile, true);
		return is_array($countryInfo) ? $countryInfo['languages'][0] : $countryInfo;
	}
	private function getCountryCodeFromIp()
	{
		$ip = $this->getIp();
		$countryCode = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
		return strtolower($countryCode['geoplugin_countryCode']);
	}
	private function getIp()
	{
		$ipAddress = 'UNKNOWN';
		if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$ipAddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} else if(isset($_SERVER['HTTP_X_REAL_IP'])) {
			$ipAddress = $_SERVER['HTTP_X_REAL_IP'];
		} else if(isset($_SERVER['HTTP_CLIENT_IP']))
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		return $ipAddress;
	}

}
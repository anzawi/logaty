<?php

namespace PHPtricks\Logaty\Helpers;
/**
 * Class Config
 */
class Config
{
    /**
     * get config value from file
     * @param $path
     * @return mixed|null
     */
	public function get($path)
	{
		$path = explode(".", $path);
		if( !is_array($path) ) {
			return null;
		}
		// get target config file
        // we store config file in (config/[config-name].php)
        // for example : language direction -> (config/direction.php)
		if(!file_exists(__DIR__ . "/../../Config/{$path[0]}.php"))
		    return null;

        $file = include (__DIR__ . "/../../Config/{$path[0]}.php");


		foreach ( $path as $item ) {
			if( isset($file[$item]) ) {
				$file = $file[$item];
			}
		}

		return $file;
	}
}
<?php

namespace PHPtricks\Logaty\Helpers\Detect;

trait Browser
{
	public function browser()
	{
		return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
}
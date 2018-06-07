<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait Ul
{
	public function ul()
	{
		global $logaty;
		$html = "<ul class='logaty-switcher'>";

		foreach ( $logaty->enabled as $lang ) {
			$html .= "<li class='logaty-switcher__li' data-value='". $lang ."'>";
			$html .= "<a href='" . $logaty->link('', $lang) . "'>";
			$html .= "<img src='" . $logaty->flag($lang) . "'";
			$html .=  $logaty->nameN($lang);
			$html .= "</a>";
			$html .= "</li>";
		}

		return $html . '</ul>';
	}
}
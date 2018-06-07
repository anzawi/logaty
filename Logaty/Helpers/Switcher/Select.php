<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait Select
{
	public function select()
	{
		global $logaty;
		$id = uniqid();
		$html = "<select id='{$id}' class='logaty-switcher'>";

		foreach ( $logaty->enabled as $lang ) {
			$html .= "<option class='logaty-switcher__option' value='". $logaty->link('', $lang) ."'>";
			$html .= $logaty->nameN($lang);
			$html .= "</option>";
		}
		
		$script = "<script>var select_element = document.getElementById('$id');select_element.onchange = function() { var elem = (typeof this.selectedIndex === "undefined" ? window.event.srcElement : this);var value = elem.value || elem.options[elem.selectedIndex].value;window.location.href = value;}​</script>";

		return $html . '</select>' . $script;
	}
}
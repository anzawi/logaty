<?php

namespace PHPtricks\Logaty\Helpers\Switcher;

trait Select
{
	public function select()
	{
		$id = 'logaty_' . uniqid();
		return $this->render('select', $id);
	}
}
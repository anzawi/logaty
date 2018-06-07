<?php

namespace PHPtricks\Logaty;

use ArrayAccess;

class App implements ArrayAccess
{
	protected $items = [],
			  $cache = [];

    public function __get($property)
	{
		return $this->offsetGet($property);
	}

	public function __call($name, $arguments)
	{
		if( $this->offsetExists($name))
		    return call_user_func_array($this->items[$name], $arguments);

		return null;
	}

    /**
     * when we call $lagaty() we need to return translation
     * @param $string
     * @param string $lang
     */
	public function __invoke($string, $lang = '')
    {
        return $this->trans->getTranslate($string, $lang);
    }

    /**
     * We IMPLEMENTS ArrayAccess class
     * so please check ArrayAccess class documentation
     * https://php.net/manual/en/class.arrayaccess.php
     */

    public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}

	public function offsetGet($offset)
	{
		if( !$this->offsetExists($offset) ) {
			return null;
		}

        /**
         * check if key in cache return it directly
         */
		if( isset($this->cache[$offset]) ) {
			return $this->cache[$offset];
		}

		$item =  $this->items[$offset]();
		$this->cache[$offset] = $item;

		return $item;
	}

	public function offsetSet($offset, $value)
	{
		$this->items[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		if( isset($this->items[$offset]) ) {
			unset($this->items[$offset]);
		}
	}
}
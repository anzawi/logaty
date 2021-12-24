<?php

namespace PHPtricks\Logaty\Exceptions;

use Exception;
use PHPUnit\Util\TestDox\HtmlResultPrinter;
use Throwable;

class NameNotImplementException extends Exception
{
    protected string $instruction = "check `/Config/name.php` file to implement languages names.";

    public function __construct($language, $code = 0, Throwable $previous = null) {
        $message = "'$language' Name is not implements.";
        parent::__construct($message, $code, $previous);
    }

    protected function instruction(): string
    {
        return $this->instruction;
    }

    protected function details(): string
    {
        return "this Error in: {$this->getFile()} file in line {$this->getLine()}";
    }

    protected function _getTrace(): string
    {
        $trace =  str_replace("PHPtricks\Logaty\App->", "logaty()->", $this->getTraceAsString());
        return $trace;
    }

    protected function message(): string
    {
        return "{$this->getMessage()} \n\r {$this->details()} \n\r {$this->instruction()} \n\r {$this->_getTrace()}";
    }

    public function __toString() {
        
        return $this->message();
    }
}
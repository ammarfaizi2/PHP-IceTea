<?php

namespace Console\Exception;

use Exception;
use Console\Color\Message;

class InvalidArgumentException extends Exception
{
    public function __construct(string $msg, int $code = 0)
    {
        parent::__construct($msg, $code);
    }
}

<?php

namespace IceTea\Exceptions;

use Exception;
use IceTea\View\View;

class Handler
{
    public function __construct(Exception $e)
    {
        $this->e = $e;
    }

    public function terminate()
    {
        if ($this->e instanceof Http) {
            http_response_code(
                $httpCode = HttpResponseCode::$code[get_class($this->e)]
            );
            View::make(view("errors/".$httpCode));
        } else {
            
        }
    }
}

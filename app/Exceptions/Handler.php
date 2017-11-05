<?php

namespace App\Exceptions;

use Exception;
use IceTea\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	/**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];
}
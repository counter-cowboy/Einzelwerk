<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiRequestException extends HttpException
{
    public function __construct(
        public $message = null,
        public $code = 0
    ) {
        parent::__construct($message, $code);
    }
}

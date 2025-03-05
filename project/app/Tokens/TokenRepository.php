<?php

namespace App\Tokens;

class TokenRepository
{
    public string $token;

    public function __construct()
    {
        $this->token = file_get_contents('/var/www/html/token');
    }

    public function getToken()
    {
        return $this->token;
    }

}

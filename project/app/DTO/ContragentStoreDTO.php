<?php

namespace App\DTO;

use App\Http\Requests\ContragentRequest;

class ContragentStoreDTO
{
    public function __construct(
        public ContragentRequest $request,
        public string $token
    ) {
    }

}

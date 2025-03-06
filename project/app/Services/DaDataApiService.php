<?php

namespace App\Services;

use App\Exceptions\ApiRequestException;
use Dadata\DadataClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class DaDataApiService
{
    public function fetchData(string $token, string $inn)
    {
        $dadata = new DadataClient($token, null);

        try {
            return $dadata->findById("party", $inn, 1);

        } catch (GuzzleException $exception) {

            Log::channel('agent')->error($exception->getCode() . ' ' . $exception->getMessage());
            throw new ApiRequestException('Error request API'. $exception->getMessage(), $exception->getCode());
        }
    }
}

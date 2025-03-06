<?php

namespace App\Services;

use App\DTO\ContragentStoreDTO;
use App\Exceptions\ApiRequestException;
use App\Exceptions\DbContragentException;
use App\Http\Requests\ContragentRequest;
use App\Models\Contragent;
use Dadata\DadataClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function MongoDB\BSON\toJSON;

class ContragentStoreService
{
    public function __construct(private readonly DaDataApiService $apiService)
    {
    }

    /**
     * @throws DbContragentException
     */
    public function store(ContragentStoreDTO $dto)
    {
        $inn = $dto->request->validated();

        try {
            $daData = $this->apiService->fetchData($dto->token, $inn);
        } catch (ApiRequestException $exception) {
            throw new DbContragentException(
                'Error API request. ' . $exception->getMessage(),
                $exception->getCode()
            );
        }

        $name = $daData[0]['data']['name']['short_with_opf'];
        $ogrn = $daData[0]['data']['ogrn'];
        $address = $daData[0]['data']['address']['unrestricted_value'];

        try {
            DB::beginTransaction();

            $contragent = Contragent::firstOrCreate([
                'name' => $name,
                'ogrn' => $ogrn,
                'address' => $address,
                'user_id' => Auth::id(),
            ]);

            DB::commit();

            return $contragent;

        } catch (Exception $exception) {

            DB::rollBack();
            Log::channel('agent')->error($exception->getMessage());

            throw new DbContragentException(
                'Error writing to DB. ' . $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}

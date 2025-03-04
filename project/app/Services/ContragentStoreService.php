<?php

namespace App\Services;

use App\DTO\ContragentStoreDTO;
use App\Http\Requests\ContragentRequest;
use App\Models\Contragent;
use Dadata\DadataClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContragentStoreService
{
    public function store(ContragentStoreDTO $dto): Contragent
    {
        $inn = $dto->request->validated();

        $dadata = new DadataClient($dto->token, null);
        $result = $dadata->findById("party", $inn, 1);

        $name = $result[0]['data']['name']['short_with_opf'];
        $ogrn = $result[0]['data']['ogrn'];
        $address = $result[0]['data']['address']['unrestricted_value'];
        $contragent = null;

        try {
            DB::beginTransaction();

            $contragent = Contragent::firstOrCreate([
                'name' => $name,
                'ogrn' => $ogrn,
                'address' => $address,
                'user_id' => Auth::id(),

            ]);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('agent')->error($exception->getMessage());
        }

        return $contragent;
    }
}

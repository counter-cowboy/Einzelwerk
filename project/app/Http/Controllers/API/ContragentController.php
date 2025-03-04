<?php

namespace App\Http\Controllers\API;

use App\DTO\ContragentStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContragentRequest;
use App\Http\Resources\ContragentResource;
use App\Services\ContragentStoreService;
use Illuminate\Support\Facades\Auth;

class ContragentController extends Controller
{
    private string $token;

    public function __construct()
    {
        $this->token = file_get_contents('/var/www/html/token');
    }

    public function index()
    {
        $contragents = Auth::user()->contragent()
            ->where('user_id', '=', Auth::id())->get();

        return ContragentResource::collection($contragents);
    }

    public function store(ContragentRequest $request, ContragentStoreService $storeService)
    {
        return new ContragentResource(
            $storeService
                ->store(new ContragentStoreDTO($request, $this->token))
        );
    }
}

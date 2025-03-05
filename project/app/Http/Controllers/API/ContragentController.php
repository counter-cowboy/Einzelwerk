<?php

namespace App\Http\Controllers\API;

use App\DTO\ContragentStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContragentRequest;
use App\Http\Resources\ContragentResource;
use App\Services\ContragentStoreService;
use App\Tokens\TokenRepository;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *     title="Contragents DaData API",
 *     version="1.0",
 *     description="This is API documentation for requests and responses, allowing users to save and display contragents from DaDataAPI",
 *     @OA\Items(
 *         type="string"
 *     )
 * )
 *
 */
class ContragentController extends Controller
{
    private string $token;

    public function __construct()
    {
        $this->token = (new TokenRepository())->getToken();
    }

    /**
     * @OA\Get(
     *     path="/api/contragents",
     *     summary="Fetch data for authorized user",
     *     @OA\Response(
     *         response="200",
     *          description="success",
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="data", type="array",
     *         @OA\Items(
     *             type="string"
     *       )
     *     ),
     *
     * )
     * )
     * )
     */
    public function index()
    {
        $contragents = Auth::user()->contragent()->get();

        return ContragentResource::collection($contragents);
    }

    public function store(ContragentRequest $request, ContragentStoreService $storeService)
    {
        $contragent = $storeService->store(new ContragentStoreDTO($request, $this->token));

        if (null == $contragent) {
            return response()->json(['error' => 'Database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return new ContragentResource($contragent);
        }
    }
}

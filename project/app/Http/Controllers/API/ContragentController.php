<?php

namespace App\Http\Controllers\API;

use App\DTO\ContragentStoreDTO;
use App\Exceptions\DbContragentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContragentRequest;
use App\Http\Resources\ContragentResource;
use App\Models\Contragent;
use App\Services\ContragentStoreService;
use App\Tokens\TokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
     *     summary="Получить список контрагентов",
     *     description="Метод возвращает список контрагентов для авторизованного пользователя.",
     *     operationId="getContragents",
     *     tags={"Contragents"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Список контрагентов успешно получен",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ContragentResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Внутренняя ошибка сервера",
     *     )
     * )
     * @OA\SecurityScheme(
     *      securityScheme="sanctum",
     *      type="http",
     *      scheme="bearer",
     *      bearerFormat="Sanctum",
     *      description="Токен авторизации для доступа "
     *  )
     *
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        $contragents = Auth::user()->contragent()->get();

        if (null == $contragents) {
            return response()->json([
                'message' => 'No contragents created yet',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ContragentResource::collection($contragents);
    }

    public function store(ContragentRequest $request, ContragentStoreService $storeService): JsonResponse
    {
        try {
            $contragent = $storeService->store(new ContragentStoreDTO($request, $this->token));

            return response()->json(['data' => $contragent], Response::HTTP_OK);

        } catch (DbContragentException $exception) {
            return response()->json(['error' => $exception->getMessage(), $exception->getCode()],
                Response::HTTP_BAD_REQUEST);

        } catch (Throwable $ex) {
            return response()->json(['error' => 'Internal error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

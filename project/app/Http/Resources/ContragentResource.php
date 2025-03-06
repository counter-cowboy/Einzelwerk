<?php

namespace App\Http\Resources;

use App\Models\Contragent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="ContragentResource",
 *      type="object",
 *      required={"id", "name"},
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID контрагента"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Название контрагента"
 *      ),
 *     @OA\Property(
 *           property="address",
 *           type="string",
 *           description="Адрес"
 *       ),
 *     @OA\Property(
 *           property="ogrn",
 *           type="string",
 *           description="ОГРН"
 *       ),
 *      @OA\Property(
 *          property="created_at",
 *          type="string",
 *          format="date-time",
 *          description="Дата создания"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          type="string",
 *          format="date-time",
 *          description="Дата последнего обновления"
 *      )
 *  )
 * */
class ContragentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ogrn' => $this->ogrn,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user_id' => $this->user_id,
        ];
    }
}

<?php

namespace App\Http\Resources\Api\Car;

use App\Http\Resources\MetaPaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="CarIndexResource",
 *     @OA\Property(
 *          property="data",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/CarResource")
 *     ),
 *     @OA\Property(property="meta", ref="#/components/schemas/MetaPaginationResource"),
 * )
 */
class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CarResource::collection($this->items()),
            'meta' => MetaPaginationResource::make($this)
        ];
    }
}

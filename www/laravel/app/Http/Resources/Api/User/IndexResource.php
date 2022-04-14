<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\MetaPaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="UserIndexResource",
 *     @OA\Property(
 *          property="data",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/UserResource")
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
            'data' => UserResource::collection($this->items()),
            'meta' => MetaPaginationResource::make($this)
        ];
    }
}

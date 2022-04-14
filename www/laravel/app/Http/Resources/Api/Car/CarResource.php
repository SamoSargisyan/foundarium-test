<?php

namespace App\Http\Resources\Api\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * @OA\Schema(schema="CarResource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="state_number", type="string", example="o 111 oo 72"),
     *     @OA\Property(property="user_id", type="integer", example=1),
     * )
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state_number' => $this->state_number,
            'user_id' => $this->user_id,
        ];
    }
}

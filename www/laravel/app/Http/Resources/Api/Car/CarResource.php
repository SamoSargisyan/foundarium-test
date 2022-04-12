<?php

namespace App\Http\Resources\Api\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * @OA\Schema(schema="CarResource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="name"),
     *     @OA\Property(property="email", type="string", example="email@mail.com"),
     * )
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}

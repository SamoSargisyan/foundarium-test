<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="MetaPaginationResource",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=1),
 *     @OA\Property(property="total", type="integer", example=1)
 * )
 */
class MetaPaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'current_page' => (int)$this->currentPage(),
            'last_page' => (int)$this->lastPage(),
            'per_page' => (int)$this->perPage(),
            'total' => (int)$this->total(),
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Car;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(schema="CarIndexRequest",
 *     @OA\Property(property="page", type="integer", nullable=true, example=1),
 *     @OA\Property(property="per_page", type="integer", nullable=true, example=25),
 * )
 */
class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'sometimes|nullable|integer|min:1',
            'per_page' => 'sometimes|nullable|integer|min:1|max:100',
        ];
    }
}

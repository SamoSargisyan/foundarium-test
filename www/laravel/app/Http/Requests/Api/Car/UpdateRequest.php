<?php

namespace App\Http\Requests\Api\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(schema="CarUpdateRequest",
 *     required={"id"},
 *     @OA\Property(property="id", type="integer", nullable=false, example=1),
 *     @OA\Property(property="state_number", type="string", nullable=true, example="o 123 oo 72"),
 *     @OA\Property(property="user_id", type="integer", nullable=true, example=1),
 * )
 */
class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int',
                'min:1',
                Rule::exists('cars', 'id')
                    ->whereNull('deleted_at')
            ],
            'state_number' => [
                'sometimes',
                'nullable',
                'string',
                Rule::unique('cars')
                    ->whereNull('deleted_at'),
            ],
            'user_id' => [
                'sometimes',
                'nullable',
                'integer',
                'min:1',
                Rule::unique('cars')
                    ->whereNull('deleted_at'),
                Rule::exists('users', 'id')
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}

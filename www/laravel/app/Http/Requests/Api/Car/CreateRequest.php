<?php

namespace App\Http\Requests\Api\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(schema="CarCreateRequest",
 *     required={"state_number"},
 *     @OA\Property(property="state_number", type="string", example="o 111 oo 72", description="Гос. номер"),
 *     @OA\Property(property="user_id", type="integer", nullable=true, example=1),
 * )
 */
class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state_number' => [
                'required',
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

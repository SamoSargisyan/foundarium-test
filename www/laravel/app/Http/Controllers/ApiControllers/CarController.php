<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Car\IndexRequest;
use App\Http\Resources\Api\Car\IndexResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/cars",
     *     summary="Получить всех пользователей",
     *     tags={"Пользователи"},
     *     @OA\Parameter(
     *         in="query",
     *         name="page",
     *         @OA\Schema(type="integer", example=1),
     *         description="Номер страницы"
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="per_page",
     *         @OA\Schema(type="integer", example=10),
     *         description="Кол-во записей на странице"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(ref="#/components/schemas/CarIndexResource")
     *     ),
     * )
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $perPage = $request->per_page ?? 25;

        $users = Car::query()
            ->paginate($perPage);

        return response()->json(IndexResource::make($users));
    }
}

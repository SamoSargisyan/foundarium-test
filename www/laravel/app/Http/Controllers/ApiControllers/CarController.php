<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Car\CreateRequest;
use App\Http\Requests\Api\Car\IndexRequest;
use App\Http\Requests\Api\Car\UpdateRequest;
use App\Http\Resources\Api\Car\CarResource;
use App\Http\Resources\Api\Car\IndexResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/cars",
     *     summary="Получить все автомобили",
     *     tags={"Автомобили"},
     *     @OA\Parameter(
     *         in="query",
     *         name="free",
     *         @OA\Schema(type="bool", example=1),
     *         description="Поиск только свободных машин"
     *     ),
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
            ->when($request->free, fn($query) => $query->whereNull('user_id'))
            ->paginate($perPage);

        return response()->json(IndexResource::make($users));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/cars/create",
     *     summary="Создать автомобиль",
     *     tags={"Автомобили"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarCreateRequest"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успех",
     *         @OA\JsonContent(ref="#/components/schemas/CarResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ValidationException")
     *         )
     *     ),
     * )
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $car = Car::create($request->validated());

        return response()->json(CarResource::make($car));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/cars/update",
     *     summary="Обновить автомобиль",
     *     tags={"Автомобили"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarUpdateRequest"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ответ",
     *         @OA\JsonContent(ref="#/components/schemas/CarResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ValidationException")
     *         )
     *     ),
     * )
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $car = Car::find($request->id);

        $car->update($request->validated());

        return response()->json(CarResource::make($car));
    }
}

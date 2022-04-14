<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\IndexRequest;
use App\Http\Resources\Api\User\IndexResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/users",
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
     *         @OA\JsonContent(ref="#/components/schemas/UserIndexResource")
     *     ),
     * )
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $perPage = $request->per_page ?? 25;

        $users = User::query()
            ->paginate($perPage);

        return response()->json(IndexResource::make($users));
    }

}

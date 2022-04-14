<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateFree()
    {
        $car = Car::factory()
            ->free()
            ->create();

        $this->assertDatabaseHas('cars', [
            'state_number' => $car->state_number,
        ]);
    }

    public function testCreateWithUser()
    {
        $car = Car::factory()
            ->create();

        $this->assertDatabaseHas('car_user', [
            'car_id' => $car->id,
            'user_id' => $car->user_id,
        ]);
    }

    // create car with user who already has a car
    public function testCreateWithUserWhoHasCar()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->json('PUT', 'api/v1/cars/update', [
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testStopBeCarOwner()
    {
        // create
        $car = Car::factory()
            ->create();

        // find it
        $carUser = CarUser::query()
            ->where('car_id', $car->id)
            ->whereNotNull('user_id')
            ->whereNull('deleted_at')
            ->exists();

        $this->assertTrue($carUser);

        // delete
        $car->update([
            'user_id' => null
        ]);

        // never more
        $carUser = CarUser::query()
            ->where('car_id', $car->id)
            ->whereNotNull('user_id')
            ->whereNull('deleted_at')
            ->exists();

        $this->assertFalse($carUser);
    }
}

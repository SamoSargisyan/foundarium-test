<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\CarUser;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function created(Car $car)
    {
        if ($car->user_id) {
            CarUser::create([
                'car_id' => $car->id,
                'user_id' => $car->user_id,
            ]);
        }
    }

    /**
     * Handle the Car "updated" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function updated(Car $car)
    {
        if ($car->isDirty('user_id')) {
            $history = CarUser::query()
                ->where('car_id', $car->id)
                ->where('user_id', $car->getOriginal('user_id'))
                ->whereNull('deleted_at')
                ->first();

            if ($history) {
                $history->delete();
            }

            if (!is_null($car->user_id)) {
                CarUser::create([
                    'car_id' => $car->id,
                    'user_id' => $car->user_id
                ]);
            }
        }
    }

    /**
     * Handle the Car "deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function deleted(Car $car)
    {
        //
    }

    /**
     * Handle the Car "restored" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function restored(Car $car)
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function forceDeleted(Car $car)
    {
        //
    }
}

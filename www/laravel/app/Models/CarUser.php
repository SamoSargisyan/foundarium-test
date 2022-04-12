<?php

namespace App\Models;

use App\Models\Traits\Relations\CarUserRelation;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CarUser extends Pivot
{
    use CarUserRelation;

    protected $fillable = [
        'car_id',
        'user_id',
    ];
}

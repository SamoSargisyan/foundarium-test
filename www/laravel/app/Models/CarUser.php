<?php

namespace App\Models;

use App\Models\Traits\Relations\CarUserRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarUser extends Model
{
    use SoftDeletes;
    use CarUserRelation;

    protected $table = 'car_user';
    protected $fillable = [
        'car_id',
        'user_id',
    ];
}

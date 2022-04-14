<?php

namespace App\Models;

use App\Models\Traits\Relations\CarRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    use HasFactory;
    use CarRelations;

    protected $fillable = [
        'state_number',
        'user_id',
    ];

}

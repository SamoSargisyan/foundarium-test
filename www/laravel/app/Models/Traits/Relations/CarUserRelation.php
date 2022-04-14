<?php

namespace App\Models\Traits\Relations;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CarUserRelation
{
    public function story(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

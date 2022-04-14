<?php

namespace App\Models\Traits\Relations;

use App\Models\Car;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelations
{
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}

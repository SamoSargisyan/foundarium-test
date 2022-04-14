<?php

namespace App\Models\Traits\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CarRelations
{
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

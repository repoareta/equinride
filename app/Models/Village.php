<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    /**
     * Get the district that owns the village.
     */
    public function district()
    {
        return $this->hasMany(District::class);
    }
}

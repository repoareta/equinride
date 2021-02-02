<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Get the districts for city.
     */
    public function district()
    {
        return $this->hasMany(District::class);
    }

    /**
     * Get the city that owns the district.
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}

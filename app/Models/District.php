<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * Get the districts for city.
     */
    public function villages()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    /**
     * Get the city that owns the district.
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * Get the cities for Province.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }    
    protected $casts = [
        'id' => 'integer',
    ];
    public function stable()
    {
        return $this->hasOne(Stable::class);
    }
}

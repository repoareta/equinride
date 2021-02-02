<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Get the all cities of this Province.
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function stable()
    {
        return $this->hasOne(Stable::class);
    }
}

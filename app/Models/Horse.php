<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    /**
    * Get the stable of horse
    */
    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }

    /**
     * Get sex of horse
     *
     * @return void
     */
    public function sex()
    {
        return $this->belongsTo(HorseSex::class, 'horse_sex_id');
    }

    /**
     * Get breed of horse
     *
     * @return void
     */
    public function breed()
    {
        return $this->belongsTo(HorseBreed::class, 'horse_breed_id');
    }
}

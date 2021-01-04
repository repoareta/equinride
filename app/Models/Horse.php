<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    /**
    * Get the owner of coach
    */
    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }
    public function sex()
    {
        return $this->belongsTo(HorseSex::class, 'horse_sex_id');
    }
    public function breed()
    {
        return $this->belongsTo(HorseBreed::class, 'horse_breed_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable=['user_id','date','time_start', 'time_end','capacity','capacity_booked'];
    /**
    * Get the owner of stable
    */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * The products that belong to the shop.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    
    /**
    * Get the owner of package
    */
    protected $fillable=['user_id','date','time_start', 'time_end','capacity','capacity_booked','stable_id'];
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
    * Get the owner of slot
    */
    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }

    /**
     * The products that belong to the shop.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

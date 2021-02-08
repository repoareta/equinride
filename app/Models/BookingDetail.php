<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable=['package_id','price_subtotal','booking_id'];
    /**
    * Get the owner of coach
    */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
    * Get the owner of coach
    */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    protected $appends = [
        'package_name',
        'stable_name',
        'stable_location'
    ];

    public function getPackageNameAttribute()
    {
        return $this->package()->first()->name;
    }

    public function getStableNameAttribute()
    {
        $package = Package::find($this->package_id);
        $stable = Stable::find($package->stable_id);

        return $stable->name;
    }


    public function getStableLocationAttribute()
    {
        $package = Package::find($this->package_id);
        $stable = Stable::find($package->stable_id);

        return $stable->city->name;
    }
}

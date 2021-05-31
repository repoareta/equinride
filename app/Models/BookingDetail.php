<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use willvincent\Rateable\Rateable;
class BookingDetail extends Model
{
    use HasFactory;
    use Rateable;

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

    public function getPackageNameAttribute()
    {
        return $this->package->name;
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

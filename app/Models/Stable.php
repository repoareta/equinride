<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use willvincent\Rateable\Rateable;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Stable extends Model
{
    use HasFactory;
    use HasRelationships;
    use Rateable;

    /**
    * Get the owner of stable
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
    * Get the horses of stable
    */
    public function horses()
    {
        return $this->hasMany(Horse::class);
    }

    /**
    * Get the coaches of stable
    */
    public function coaches()
    {
        return $this->hasMany(Coach::class);
    }

    /**
    * Get the package of stable
    */
    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    /**
    * Get the slot of stable
    */
    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    /**
    * Get the package of stable
    */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function approvalby_stable()
    {
        return $this->belongsTo(User::class, 'approval_by');
    }

    // protected $appends = [
    //     'col_stable_admin',
    //     'col_bookings'
    // ];

    // public function getColStableAdminAttribute()
    // {
    //     $admin = Stable::with(['users'=> function ($q) {
    //         $q->whereHas("roles", function ($q) {
    //             $q->where("name", "stable-admin");
    //         });
    //     }])->where('id', $this->id)->first()->users;

    //     return $admin;
    // }

    // public function getColBookingsAttribute()
    // {
    //     $data = $this->packages->first()->booking_detail->count();

    //     return $data;
    // }

    /**
     * Get all of the booking detail for the stable.
     */
    public function booking_details()
    {
        return $this->hasManyThrough(BookingDetail::class, Package::class);
    }

    /**
     * Get all of the booking detail for the stable.
     */
    // public function bookings()
    // {
    //     return $this->booking_details->belongsTo(Booking::class);
    // }

    public function bookings()
    {
        return $this->hasManyDeepFromRelations(
            $this->booking_details(),
            (new BookingDetail)->booking()
        );
    }

    public function schedule_settings()
    {
        return $this->hasMany(SlotSetting::class);
    }
}

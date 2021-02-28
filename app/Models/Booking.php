<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    /**
    * Get the coaches of stable
    */
    public function booking_details()
    {
        return $this->hasMany(BookingDetail::class);
    }

    /**
    * Get the coaches of stable
    */
    public function booking_detail()
    {
        return $this->hasOne(BookingDetail::class);
    }

    public function bank()
    {
        return $this->belongsTo(BankPayment::class, 'bank_payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function approvalby_booking()
    {
        return $this->belongsTo(User::class, 'approval_by');
    }
}

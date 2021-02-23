<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function stable()
    {
        return $this->belongsTo(Stable::class, 'stable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvalby_package()
    {
        return $this->belongsTo(User::class, 'approval_by', 'id');
    }

    public function booking_details()
    {
        return $this->hasMany(BookingDetail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
    * Get the slots of packages for riding class
    */
    public function slot()
    {
        return $this->hasMany(Slot::class);
    }

    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvalby_package()
    {
        return $this->belongsTo(User::class, 'approval_by', 'id');
    }
}

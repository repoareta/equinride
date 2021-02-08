<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stable extends Model
{
    use HasFactory;

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

    protected $appends = [
        'col_stable_admin'
    ];

    public function getColStableAdminAttribute()
    {
        $admin = Stable::with(['users'=> function ($q){
            $q->whereHas("roles", function($q){ 
                $q->where("name", "stable-admin"); 
            });
        }])->where('id', $this->id)->first()->users;

        return $admin;
    }
}

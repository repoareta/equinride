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
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
    * Get the horses of stable
    */
    public function horse()
    {
        return $this->hasMany(Horse::class);
    }

    /**
    * Get the coaches of stable
    */
    public function coach()
    {
        return $this->hasMany(Coach::class);
    }

    /**
    * Get the package of stable
    */
    public function package()
    {
        return $this->hasMany(Package::class);
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
        return $this->belongsTo(Deistrict::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function approvalby_stable()
    {
        return $this->belongsTo(User::class, 'approval_by', 'id');
    }

}

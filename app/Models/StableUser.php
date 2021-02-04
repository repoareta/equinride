<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StableUser extends Model
{
    use HasFactory;

    protected $table = 'stable_user';
    /**
    * Get the owner of stable
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
}

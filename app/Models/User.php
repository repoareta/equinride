<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the stable associated with the user.
     */
    public function stables()
    {
        return $this->belongsToMany(Stable::class);
    }

    /**
     * Get the package associated with the user.
     */
    public function package()
    {
        return $this->hasOne(Package::class);
    }

    /**
     * Get the approval by package associated with the user.
     */
    public function approvalby_package()
    {
        return $this->hasOne(Package::class, 'approval_by', 'id');
    }
    
    /**
     * The products that belong to the shop.
     */
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function slots()
    {
        return $this->belongsToMany(Slot::class)->withTimestamps()->withPivot('qr_code_status', 'qr_code');
    }
}

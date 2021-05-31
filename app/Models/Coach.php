<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
class Coach extends Model
{
    use HasFactory;
    use Rateable;

    /**
    * Get the owner of coach
    */
    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }
}

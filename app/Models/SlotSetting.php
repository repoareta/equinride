<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotSetting extends Model
{
    use HasFactory;

    protected $table = "stable_slot_settings";

    protected $primaryKey = null;

    public $incrementing = false;
}

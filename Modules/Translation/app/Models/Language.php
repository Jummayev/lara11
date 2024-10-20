<?php

namespace Modules\Translation\app\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
        'icon_id',
    ];
}

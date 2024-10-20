<?php

namespace Modules\Translation\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category',
        'message',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(SystemMessageTranslation::class, 'message_id');
    }
}

<?php

namespace Modules\Translation\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemMessageTranslation extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'language',
        'translation',
        'message_id',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(SystemMessage::class, 'message_id');
    }
}

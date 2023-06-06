<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin IdeHelperAnswer
 */
class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditor_id',
        'interaction_id',
        'replyable_id',
        'replyable_type',
    ];

    public function interaction(): BelongsTo
    {
        return $this->belongsTo(Interaction::class);
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(Auditor::class);
    }

    public function answerable(): MorphTo
    {
        return $this->morphTo();
    }
}

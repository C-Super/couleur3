<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function interaction()
    {
        return $this->belongsTo(Interaction::class);
    }

    public function auditor()
    {
        return $this->belongsTo(Auditor::class);
    }

    public function answerable()
    {
        return $this->morphTo();
    }
}

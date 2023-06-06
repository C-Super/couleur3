<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAnswer
 *
 * @property int $id
 * @property int $auditor_id
 * @property int $interaction_id
 * @property int $replyable_id
 * @property string $replyable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Auditor $auditor
 * @property-read \App\Models\Interaction $interaction
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $answerable
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

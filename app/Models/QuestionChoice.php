<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperQuestionChoice
 */
class QuestionChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'is_correct_answer',
    ];

    public function interaction(): BelongsTo
    {
        return $this->belongsTo(Interaction::class);
    }

    public function replyable(): MorphOne
    {
        return $this->morphOne(Answer::class, 'replyable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperAnswerText
 */
class AnswerText extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function answer(): MorphOne
    {
        return $this->morphOne(Answer::class, 'answerable');
    }
}

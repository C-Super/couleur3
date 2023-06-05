<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAnswerText
 */
class AnswerText extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function answer()
    {
        return $this->morphOne(Answer::class, 'answerable');
    }
}

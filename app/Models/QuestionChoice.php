<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperQuestionChoice
 */
class QuestionChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'is_correct_answer',
        'interaction_id',
    ];
}

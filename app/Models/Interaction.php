<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperInteraction
 */
class Interaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'type',
        'call_to_action_id',
        'ended_at',
        'animator_id',
        'reward_id',
        'winners_count',
    ];

    /**
     * Get all question_choices for the interaction.
     */
    public function question_choices()
    {
        return $this->hasMany(QuestionChoice::class);
    }

    /**
     * Get the call_to_action that owns the interaction.
     */
    public function call_to_action()
    {
        return $this->belongsTo(CallToAction::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function rewards()
    {
        return $this->belongsTo(Reward::class);
    }
}

<?php

namespace App\Models;

use App\Enums\InteractionStatus;
use App\Enums\InteractionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => InteractionType::class,
        'status' => InteractionStatus::class,
    ];

    /**
     * Get all question_choices for the interaction.
     */
    public function question_choices(): HasMany
    {
        return $this->hasMany(QuestionChoice::class);
    }

    /**
     * Get the call_to_action that owns the interaction.
     */
    public function call_to_action(): BelongsTo
    {
        return $this->belongsTo(CallToAction::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function rewards(): BelongsTo
    {
        return $this->belongsTo(Reward::class);
    }
}

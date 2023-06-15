<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperAuditor
 */
class Auditor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
    ];

    /**
     * Get the animator's user.
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'roleable');
    }

    /**
     * Get the auditor's address.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /*
     * Get all of the messages for the Auditor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /*
     * Get all of the answers for the Auditor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function winners(): HasMany
    {
        return $this->hasMany(Winner::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperAuditor
 *
 * @property int $id
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Address $address
 * @property-read \Illuminate\Database\Eloquent\Collection|Answer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|Message[] $messages
 * @property-read User $user
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
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
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

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}

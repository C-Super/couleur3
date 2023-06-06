<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roleable_id',
        'roleable_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the parent roleable model (animator or auditor).
     */
    public function roleable(): MorphTo
    {
        return $this->morphTo();
    }

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function isAuditor(): bool
    {
        return $this->roleable_type === 'App\Models\Auditor';
    }

    public function isAnimator(): bool
    {
        return $this->roleable_type === 'App\Models\Animator';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->roleable_id && ! $model->roleable_type) {
                $auditor = Auditor::create();

                $model->roleable_id = $auditor->id;
                $model->roleable_type = get_class($auditor);
            }
        });
    }
}

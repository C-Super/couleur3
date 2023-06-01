<?php

namespace App\Models;

use DB;
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

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function isAuditor(): bool
    {
        return $this->roleable_type === 'App\Models\Auditor';
    }

    public function isAnimator(): bool
    {
        return $this->roleable_type === 'App\Models\Animator';
    }

    public static function create(array $attributes = [])
    {
        // Si aucun roleable n'a été fourni, créez un Auditeur par défaut
        if (!isset($attributes['roleable_id']) && !isset($attributes['roleable_type'])) {
            $auditor = new Auditor();
            $auditor->save();

            $attributes['roleable_id'] = $auditor->id;
            $attributes['roleable_type'] = DB::raw(get_class($auditor));
        }

        return parent::create($attributes);
    }
}

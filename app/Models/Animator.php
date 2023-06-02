<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperAnimator
 */
class Animator extends Model
{
    use HasFactory;

    /**
     * Get the animator's user.
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'roleable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperAuditor
 */
class Auditor extends User
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

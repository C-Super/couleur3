<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperReward
 */
class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }
}

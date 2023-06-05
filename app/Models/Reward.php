<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }
}

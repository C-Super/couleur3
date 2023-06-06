<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin IdeHelperMedia
 */
class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'type',
    ];

    public function answer(): MorphOne
    {
        return $this->morphOne(Answer::class, 'answerable');
    }
}

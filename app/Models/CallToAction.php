<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperCallToAction
 */
class CallToAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
    ];

    public function interaction(): HasOne
    {
        return $this->hasOne(Interaction::class);
    }
}

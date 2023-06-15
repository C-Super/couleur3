<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAddress
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'zip_code',
        'city',
        'country',
    ];

    public function auditor(): HasMany
    {
        return $this->hasMany(Auditor::class);
    }
}

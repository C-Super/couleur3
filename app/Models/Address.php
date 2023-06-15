<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function auditor()
    {
        return $this->hasMany(Auditor::class);
    }
}

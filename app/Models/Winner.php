<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperWinner
 */
class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'interaction_id',
        'auditor_id',
    ];
    public function interaction(): BelongsTo
    {
        return $this->belongsTo(Interaction::class);
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(Auditor::class);
    }
}

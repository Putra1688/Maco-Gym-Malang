<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberRoutine extends Model
{
    protected $fillable = [
        'member_id',
        'day_name',
        'title',
        'target_exercises',
        'is_active',
    ];

    protected $casts = [
        'target_exercises' => 'array',
        'is_active' => 'boolean',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}

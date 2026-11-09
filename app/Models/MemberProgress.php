<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberProgress extends Model
{
    protected $table = 'member_progress';

    protected $fillable = [
        'member_id',
        'weight_kg',
        'height_cm',
        'waist_cm',
        'chest_cm',
        'notes',
        'recorded_at',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'height_cm' => 'decimal:2',
        'waist_cm' => 'decimal:2',
        'chest_cm' => 'decimal:2',
        'recorded_at' => 'date',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function calculateBmi(): ?float
    {
        if ($this->height_cm <= 0) {
            return null;
        }

        $heightInMeters = $this->height_cm / 100;

        return round($this->weight_kg / ($heightInMeters * $heightInMeters), 1);
    }
}

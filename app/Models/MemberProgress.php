<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProgress extends Model
{
    protected $table = 'member_progress';

    protected $fillable = [
        'member_id',
        'weight_kg',
        'height_cm',
        'recorded_at',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'height_cm' => 'decimal:2',
        'recorded_at' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

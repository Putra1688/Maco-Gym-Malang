<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'card_id',
        'name',
        'phone',
        'gender',
        'join_date',
        'current_expiry_date',
        'status',
    ];

    protected $casts = [
        'join_date' => 'date',
        'current_expiry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function progresses()
    {
        return $this->hasMany(MemberProgress::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->current_expiry_date >= now();
    }

    public function daysRemaining(): int
    {
        return max(0, now()->diffInDays($this->current_expiry_date, false));
    }
}

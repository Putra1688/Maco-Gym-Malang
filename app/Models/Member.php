<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'card_id',
        'name',
        'phone',
        'gender',
        'birth_date',
        'join_date',
        'current_expiry_date',
        'status',
        'package_name',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'current_expiry_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->current_expiry_date >= now()->startOfDay();
    }

    public function isPending(): bool
    {
        return $this->status === 'pending_verification';
    }

    public function getSelectedPackageNameAttribute(): string
    {
        if (! empty($this->package_name)) {
            return $this->package_name;
        }

        $latestTx = $this->transactions->sortByDesc('created_at')->first();
        if ($latestTx?->package) {
            return $latestTx->package->name;
        }

        return 'Paket Reguler';
    }

    public function daysRemaining(): int
    {
        return max(0, now()->startOfDay()->diffInDays($this->current_expiry_date->startOfDay(), false));
    }

    public function monthlyAttendancesCount(): int
    {
        return $this->attendances()
            ->where('checkin_time', '>=', now()->startOfMonth())
            ->count();
    }
}

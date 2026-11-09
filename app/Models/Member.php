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
        'branch',
        'target_weight_kg',
        'fitness_goal',
        'join_date',
        'current_expiry_date',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'current_expiry_date' => 'date',
        'target_weight_kg' => 'decimal:2',
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

    public function progresses(): HasMany
    {
        return $this->hasMany(MemberProgress::class);
    }

    public function routines(): HasMany
    {
        return $this->hasMany(MemberRoutine::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->current_expiry_date >= now()->startOfDay();
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

    public function latestProgress(): ?MemberProgress
    {
        return $this->progresses()->latest('recorded_at')->first();
    }

    public function latestBmi(): ?float
    {
        $latest = $this->latestProgress();
        if (! $latest || $latest->height_cm <= 0) {
            return null;
        }

        $heightInMeters = $latest->height_cm / 100;

        return round($latest->weight_kg / ($heightInMeters * $heightInMeters), 1);
    }

    public function weightChange(): ?float
    {
        $all = $this->progresses()->oldest('recorded_at')->get();
        if ($all->count() < 2) {
            return 0.0;
        }

        $first = (float) $all->first()->weight_kg;
        $latest = (float) $all->last()->weight_kg;

        return round($latest - $first, 1);
    }
}

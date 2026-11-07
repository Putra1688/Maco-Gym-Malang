<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
        'member_id',
        'guest_name',
        'checkin_time',
        'notes',
    ];

    protected $casts = [
        'checkin_time' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

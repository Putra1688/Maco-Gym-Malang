<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'invoice_code',
        'member_id',
        'package_id',
        'customer_name',
        'customer_phone',
        'amount',
        'payment_method',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

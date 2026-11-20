<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const CARD_FEE = 20000;

    public $timestamps = false;

    protected $fillable = [
        'invoice_code',
        'member_id',
        'package_id',
        'customer_name',
        'customer_phone',
        'amount',
        'package_price',
        'card_fee',
        'payment_method',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'package_price' => 'decimal:2',
        'card_fee' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function getPackagePriceAttribute($value): float
    {
        if ($value !== null) {
            return (float) $value;
        }

        $cardFee = (float) ($this->attributes['card_fee'] ?? 0);

        return max(0, (float) ($this->attributes['amount'] ?? 0) - $cardFee);
    }

    public function getCardFeeAttribute($value): float
    {
        return (float) ($value ?? 0);
    }

    public function hasCardFee(): bool
    {
        return (float) $this->card_fee > 0;
    }

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip_code',
        'shipping_country',
        'payment_method',
        'payment_status',
        'tracking_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute()
    {
        return 'RM' . number_format($this->total, 2);
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    
    protected $fillable = [
        'user_id',
        'order_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_price',
        'items',
        'special_request',
        'status', // pending, confirmed, rejected, shipped, completed
        'payment_proof',
        'rejection_reason',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'items' => 'array',
        'special_request' => 'array',
    ];
}

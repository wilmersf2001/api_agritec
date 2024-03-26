<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tb_order';

    protected $fillable = [
        'order_code',
        'customer_name',
        'customer_ap_paterno',
        'customer_ap_materno',
        'customer_phone',
        'customer_address',
        'customer_email',
        'customer_note',
        'payment_method',
        'subtotal',
        'tax',
        'total',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

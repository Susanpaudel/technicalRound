<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'order_items',
        'total_amount',
        'order_status',
    ];

    public function setOrderItemsAttribute($value)
    {
        $this->attributes['order_items'] = json_encode($value);
    
        $total = 0;
        foreach ($value as $item) {
            $price = isset($item['price']) ? (float)$item['price'] : 0;
            $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
            $total += $price * $quantity;
        }
    
        $this->attributes['total_amount'] = number_format($total, 2, '.', '');
    }
}

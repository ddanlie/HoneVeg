<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product_lists', 'order_id', 'product_id');
    }
    
    public function sellers()
    {
        return $this->belongsToMany(User::class, 'seller_orders', 'order_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLabelValue extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'product_label_values';
    protected $primaryKey = 'product_label_values_id';
    
    public function label()
    {
        return $this->belongsTo(User::class, 'label_id', 'label_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

}

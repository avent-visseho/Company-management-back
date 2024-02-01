<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Provider;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'provider_id',
        'quantity',
        'orderDate',
        'observation',
        'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class,"product_id","id");
    }
    
    public function provider() {
        return $this->belongsTo(Provider::class,"provider_id","id");
    }
}



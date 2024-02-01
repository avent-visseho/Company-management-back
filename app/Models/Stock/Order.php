<?php

namespace App\Models\Stock;


use App\Models\Stock\Product;
use App\Models\Stock\Provider;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'product_id',
        'provider_id',
        'quantity',
        'orderDate',
        'observation',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}

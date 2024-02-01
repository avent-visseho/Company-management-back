<?php

namespace App\Models\Stock;


use App\Models\Stock\Order;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock\DamagedStockProduct;

class Stock extends Model
{
    protected $primaryKey = 'id_stock';

    protected $fillable = [
        'order_id',
        'quantity',
        'status',
        'purchasePrice',
        'entryDate',
        'expirationDate',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function damagedStockProducts()
    {
        return $this->hasMany(DamagedStockProduct::class, 'stock_id');
    }

    // Vous pouvez ajouter d'autres relations au besoin
}

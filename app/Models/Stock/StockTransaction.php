<?php

namespace App\Models\Stock;

use App\Models\Stock\Stock;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $primaryKey = 'id_stock_transaction';

    protected $fillable = [
        'stock_id',
        'quantity',
        'transaction_type',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}

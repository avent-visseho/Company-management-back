<?php

namespace App\Models\Stock;


use App\Models\Stock\Stock;
use Illuminate\Database\Eloquent\Model;

class DamagedStockProduct extends Model
{
    protected $primaryKey = 'id_DamagedStockProduct';

    protected $fillable = [
        'stock_id',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}

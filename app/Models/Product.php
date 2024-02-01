<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Categorie;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'productName',
        'unitPrice',
        'categorie_id',
    ];
    public function orders() {
        return $this->hasMany(Order::class,"product_id","id");
    }
    public function categorie() {
        return $this->belongsTo(Categorie::class,"categorie_id","id");
    }
}


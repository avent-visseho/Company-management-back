<?php

namespace App\Models\Stock;


use Illuminate\Database\Eloquent\Model;
use App\Models\Stock\Product;

class Category extends Model
{
    
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'categoryName',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

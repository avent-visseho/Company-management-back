<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'providerName',
        'providerEmail',
        'providerPhone',
        'providerIfu',
        'providerAddress',
    ];
    public function orders() {
        return $this->hasMany(Order::class,"provider_id","id");
    }
}


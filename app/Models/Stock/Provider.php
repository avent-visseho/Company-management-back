<?php

namespace App\Models\Stock;


use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $primaryKey = 'id_provider';

    protected $fillable = [
        'providerName',
        'providerEmail',
        'providerPhone',
        'providerIfu',
        'providerAddress',
    ];
}


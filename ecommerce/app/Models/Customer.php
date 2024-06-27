<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Customer extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];


    function hasOrder($productId){
        return $this-> HasManyThrough(orderItem::class, order::class)->where('product_id', $productId)->exists();
    }
}

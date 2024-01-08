<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_amount'
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}

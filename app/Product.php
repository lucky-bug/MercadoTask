<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 * @property string $name
 * @property string $unit
 * @property float $price
 * @property int $quantity
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'price',
        'quantity',
    ];
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_visible',
        'stock',
        'price',
        'attachment',
    ];

    protected $casts = [
        'price'      => MoneyCast::class,
        'is_visible' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getProducts()
    {
        return self::query()
            ->where('is_visible', 1)
            ->where('stock', '>', 0)
            ->get();
    }
}

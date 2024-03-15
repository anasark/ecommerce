<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    /**
     * Get the product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
 
    /**
     * @param int $cartId
     * @param int $productId
     * @param int $quantity
     * 
     * @return void
     */
    public static function insertItem(int $cartId, int $productId, int $quantity): void
    {
        $cartItem = self::findItem($cartId, $productId);

        if (! empty($cartItem)) {
            self::updateItem($cartItem, $quantity);
            return;
        }

        CartItem::create([
            'cart_id'    => $cartId,
            'product_id' => $productId,
            'quantity'   => $quantity,
        ]);
    }

    /**
     * @param int $cartId
     * @param int $productId
     * 
     * @return CartItem|null
     */
    public static function findItem(int $cartId, int $productId): ?CartItem
    {
        return self::query()
            ->where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }

    /**
     * @param CartItem $cartItem
     * @param int      $quantity
     * 
     * @return void
     */
    public static function updateItem(CartItem $cartItem, int $quantity): void
    {
        $cartItem->quantity = $cartItem->quantity + $quantity;
        $cartItem->save();
    }
}

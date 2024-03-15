<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id'
    ];

    /**
     * Get the cart item.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * @return Cart
     */
    public static function getCartSession(): Cart
    {
        $cart = self::getCart();

        if (empty($cart)) {
            return self::createCart();
        }

        if ($cart->session_id != Session::getId()) {
            $cart->session_id = Session::getId();
            $cart->save();
        }

        return $cart;
    }

    /**
     * @return Cart|null
     */
    public static function getCart(): ?Cart
    {
        $condition = Auth::id()
            ? ['user_id' => Auth::id()]
            : ['session_id' => Session::getId()];

        return self::query()
            ->where($condition)
            ->first();
    }

    /**
     * @return Cart
     */
    public static function createCart(): Cart
    {
        return Cart::create([
            'user_id'    => Auth::id(),
            'session_id' => Session::getId()
        ]);
    }
}

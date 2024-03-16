<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'subtotal',
        'tax',
        'total',
        'status',
    ];

    public const STATUS_PAID     = 'paid';
    public const STATUS_PENDING  = 'pending';
    public const STATUS_CANCELED = 'canceled';

    /** @var integer[] */
    public const STATUS = [
        self::STATUS_PAID,
        self::STATUS_PENDING,
        self::STATUS_CANCELED,
    ];

    /**
     * Get the order.
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    /**
     * @return string
     */
    public static function generateCode(): string
    {
        $id = self::all()->last()?->id;

        $id = $id ? $id + 1 : 1;

        return 'INV' . str_pad($id, 5, "0", STR_PAD_LEFT);
    }

    /**
     * @param string $code
     * 
     * @return Invoice
     */
    public static function getByCode(string $code): Invoice
    {
        return self::where('code', $code)->firstOrFail();
    }
}

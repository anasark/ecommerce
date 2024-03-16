<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_id',
    ];

    /**
     * Get the order items
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the invoice
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order name.
     *
     * @return string
     */
    public function getOrderTitleAttribute(): string
    {
        $text = '';
        foreach ($this->orderItems as $item) {
            if ($item->id === $this->orderItems->first()->id) {
                $text .= $item->product->name;
            } elseif ($item->id === $this->orderItems->last()->id) {
                $text .= ' and ' . $item->product->name . '.';
            } else {
                $text .= ', ' . $item->product->name;
            }
        }
        return $text;
    }

    public function getOrderTitle()
    {
        return $this->orderTitle;
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\Cart as ModelsCart;
use App\Models\CartItem;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $cartItems;
    public $subtotal = 0;
    public $tax      = 0;
    public $total    = 0;

    public function mount(ModelsCart $cart)
    {
        $this->cart      = $cart;
        $this->cartItems = $cart->cartItems;

        $this->countSubtotal();
        $this->countTax();
        $this->countTotal();
    }

    public function render()
    {
        return view('livewire.pages.cart');
    }

    private function countSubtotal()
    {
        $subtotal = 0;

        foreach ($this->cartItems as $items) {
            $subtotal += ($items->quantity * $items->product->price);
        }

        $this->subtotal = $subtotal;
    }

    private function countTax()
    {
        $this->tax = $this->subtotal * 0.11;
    }

    private function countTotal()
    {
        $this->total = $this->subtotal + $this->tax;
    }

    #[On('refresh-component')]
    public function refreshComponent()
    {
        $this->dispatch('$refresh');
        $this->countSubtotal();
        $this->countTax();
        $this->countTotal();
    }

    #[On('registered')]
    public function checkout()
    {
        $this->setCartUserId();

        DB::beginTransaction();

        try {
            $invoice = $this->createInvoice();
            $order   = $this->createOrder($invoice);

            foreach ($this->cartItems as $cartItem) {
                $this->createOrderItem($order, $cartItem);
            }

            $this->cart->delete();

            DB::commit();

            return redirect()->route('invoice.view', $invoice->code);
        } catch (\Exception $e) {
            DB::rollback();

            $this->dispatch(
                'show-notification',
                message: $e->getMessage(),
                isSuccess: false,
                manualCloseReload: true
            );

            Log::error($e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function setCartUserId()
    {
        $this->cart->user_id = Auth::id();
        $this->cart->save();
    }

    private function createInvoice()
    {
        return Invoice::create([
            'code'     => Invoice::generateCode(),
            'subtotal' => $this->subtotal,
            'tax'      => $this->tax,
            'total'    => $this->total,
        ]);
    }

    private function createOrder(Invoice $invoice)
    {
        return Order::create([
            'user_id'    => Auth::id(),
            'invoice_id' => $invoice->id,
        ]);
    }

    private function createOrderItem(Order $order, CartItem $cartItem)
    {
        // check stock
        if ($cartItem->quantity > $cartItem->product->stock) {
            throw new \Exception('Stock not enough');
        }

        // decrement stock
        $cartItem->product->stock -= $cartItem->quantity;
        $cartItem->product->save();

        // delete from cart item
        $cartItem->delete();

        // create order item
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity'   => $cartItem->quantity,
            'price'      => $cartItem->product->price,
        ]);
    }

    #[On('notification-closed')]
    public function closeNotification()
    {
        header('Location: ' . route('cart'));
        exit;
    }
}

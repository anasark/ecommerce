<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request)
    {
        if (! $this->validateInvoice($request->code)) {
            throw new \Exception('Invalid request');
        }

        // Set Midtrans configuration
        Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        // Set transaction details
        $transaction_details = $this->getTransactionDetail($request->code);

        // Set customer details (optional)
        $customer_details = $this->getCustomerDetail();

        // Generate Snap Token
        $snapToken = Snap::getSnapToken([
            'transaction_details' => $transaction_details,
            'customer_details'    => $customer_details,
        ]);

        // Redirect to Midtrans payment page
        return redirect()->away(Snap::getSnapUrl([
            'token'               => $snapToken,
            'transaction_details' => $transaction_details,
        ]));
    }

    /**
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        $params = explode('-', $request->order_id);
        $code = $params[0];

        if ($request->status_code == 200) {
            $invoice         = Invoice::getByCode($code);
            $invoice->status = Invoice::STATUS_PAID;
            $invoice->save();
        }

        return redirect()->route('invoice.view', $code);
    }

    /**
     * @param string|null $code
     * 
     * @return bool
     */
    private function validateInvoice(string $code = null): bool
    {
        if (empty($code)) {
            return false;
        }

        $invoice = Invoice::getByCode($code);

        return $invoice->order->user_id == Auth::id();
    }

    /**
     * @param string $code
     * 
     * @return array
     */
    private function getTransactionDetail(string $code): array
    {
        $invoice = Invoice::getByCode($code);

        return [
            'order_id'     => $invoice->code . '-' . now(),
            'gross_amount' => $invoice->total,
        ];
    }

    /**
     * @return array
     */
    private function getCustomerDetail(): array
    {
        $user  = Auth::user();
        $parts = explode(' ', $user->name);

        if (count($parts) > 1) {
            $lastname  = array_pop($parts);
            $firstname = implode(' ', $parts);
        } else {
            $firstname = $user->name;
            $lastname  = $user->name;
        }

        return [
            'first_name'    => $firstname,
            'last_name'     => $lastname,
            'email'         => $user->email,
        ];
    }
}

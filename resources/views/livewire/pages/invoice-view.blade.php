<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice #') . $invoice->code }}
        </h2>
    </x-slot>

    <div class="flex flex-col justify-center">
        <div class="py-8 px-2 md:p-16 max-w-screen-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg mx-auto">
            <div class="grid grid-cols-2 text-gray-700 dark:text-gray-300">
                <p>Status: <span class="font-bold uppercase text-lg">{{ $invoice->status }}</span></p>
                <p class="text-right">{{ date('l, m Y', strtotime($invoice->created_at)) }}</p>
            </div>

            <table class="mt-6 table-auto">
                <thead>
                    <tr class="text-left">
                        <th class="p-3 md:px-10 text-white bg-gray-500 rounded-l-lg">Item</th>
                        <th class="p-3 md:px-10 text-white bg-gray-500">Price</th>
                        <th class="p-3 md:px-10 text-white bg-gray-500">Qty</th>
                        <th class="p-3 md:px-10 text-white bg-gray-500 rounded-r-lg">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td class="p-3 md:py-5 md:px-10 font-bold">{{ $item->product->name }}</td>
                            <td class="p-3 md:py-5 md:px-10">{{ Str::price($item->price) }}</td>
                            <td class="p-3 md:py-5 md:px-10">{{ $item->quantity }}</td>
                            <td class="p-3 md:py-5 md:px-10">{{ Str::price($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="my-5 mx-3 sm:mx-7 mb-3 border-gray-500">

            <div class="pt-4 grid grid-cols-1 md:grid-cols-2">
                <div class="col-start-1 md:col-start-2">
                    <div class="px-3 sm:px-7 pb-3 flex justify-between">
                        <p>Subtotal</p>
                        <p class="font-bold">{{ Str::price($invoice->subtotal) }}</p>
                    </div>

                    <div class="px-3 sm:px-7 pb-3 flex justify-between">
                        <p>Tax <span class="text-sm">(11%)</span></p>
                        <p class="font-bold">{{ Str::price($invoice->tax) }}</p>
                    </div>

                    <div class="px-3 sm:px-7 pb-3 sm:pb-7 flex justify-between">
                        <p class="font-bold">Total</p>
                        <p class="font-bold">{{ Str::price($invoice->total) }}</p>
                    </div>

                    @if ($invoice->status != \App\Models\Invoice::STATUS_PAID)
                        <a href="{{ route('payment', ['code' => $invoice->code]) }}" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 px-8 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Pay Now
                        </a>
                    @endif
                <div>
            </div>
        </div>
    </div>
</div>

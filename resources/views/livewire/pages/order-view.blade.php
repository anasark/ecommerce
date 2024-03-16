<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order #') . $order->id }}
        </h2>
    </x-slot>

    <div class="flex flex-col justify-center">
        <div class="p-8 md:p-16 max-w-screen-lg bg-white p-3 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg mx-auto">
            <div class="grid grid-cols-2 text-gray-700 dark:text-gray-300">
                <p class>
                    Invoice: <a href="{{ route('invoice.view', $order->invoice->code) }}" class="py-1 px-4 rounded-full bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 ">{{ $order->invoice->status }}</a>
                </p>
                <p class="text-right">{{ date('l, d F Y', strtotime($order->created_at)) }}</p>
            </div>

            <table class="mt-6 table-auto">
                <thead>
                    <tr class="text-left">
                        <th class="p-3 md:px-10 text-white bg-gray-500 rounded-l-lg">Item</th>
                        <th class="p-3 md:px-10 text-white bg-gray-500">Price</th>
                        <th class="p-3 md:px-10 text-white bg-gray-500 rounded-r-lg">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td class="p-3 md:py-5 md:px-10 font-bold">{{ $item->product->name }}</td>
                            <td class="p-3 md:py-5 md:px-10">{{ Str::price($item->price) }}</td>
                            <td class="p-3 md:py-5 md:px-10">{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

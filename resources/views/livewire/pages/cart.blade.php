<div>
    <livewire:components.notification />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-start-1 md:col-span-2">
            <div class="flex flex-col justify-center bg-white p-3 dark:bg-gray-800 shadow sm:rounded-lg">
                @forelse ($cartItems as $cartItem)
                    <livewire:components.cart-item :$cartItem :key="$cartItem->id" />
                @empty
                    <div class="flex justify-center">
                        <p class="text-gray-900 dark:text-gray-100 p-3 sm:p-7">Carts is empty</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-start-1 md:col-start-3">
            <div class="bg-white p-3 dark:bg-gray-800 shadow sm:rounded-lg text-gray-900 dark:text-gray-100">
                <h2 class="p-3 sm:p-7 text-xl font-bold tracking-tight">Order summary</h2>
                
                <div class="px-3 sm:px-7 pb-3 flex justify-between">
                    <p>Subtotal</p>
                    <p>{{ Str::price($subtotal) }}</p>
                </div>

                <hr class="mx-3 sm:mx-7 mb-3 border-gray-500">

                <div class="px-3 sm:px-7 pb-3 flex justify-between">
                    <p>Tax <span class="text-sm">(11%)</span></p>
                    <p>{{ Str::price($tax) }}</p>
                </div>

                <hr class="mx-3 sm:mx-7 mb-3 border-gray-500">

                <div class="px-3 sm:px-7 pb-3 sm:pb-7 flex justify-between">
                    <p class="font-bold">Total</p>
                    <p class="font-bold">{{ Str::price($total) }}</p>
                </div>

                <div class="px-3 sm:px-7 pb-3 sm:pb-7 flex justify-between">
                    @auth
                        <button wire:click="checkout" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 px-8 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Checkout
                        </button>
                    @else
                        <button data-modal-target="register-modal" data-modal-toggle="register-modal" type="button" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 px-8 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Register & Checkout
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Register modal -->
    <div id="register-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Register
                    </h3>
                    <button id="buttob-close-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="register-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <livewire:components.register-checkout />
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    Livewire.on('registered', () => {
        document.getElementById("buttob-close-modal").click();
    })
</script>
@endscript

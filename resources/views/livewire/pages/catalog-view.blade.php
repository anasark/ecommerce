<div>
    <livewire:components.notification />

    <div class="grid grid-cols-1 md:grid-cols-8 gap-4">
        <div class="col-start-1 col-span-8 md:col-span-2">
            <div class="flex justify-center bg-white p-3 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="h-full max-w-48 overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $product->attachment) }}" class="h-full w-full object-cover object-center">
                </div>
            </div>
        </div>

        <div class="col-start-1 md:col-start-3 col-span-8 md:col-span-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-2xl">{{ $product->name }}</h2>
            <h1 class="mt-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-3xl">{{ Str::price($product->price) }}</h1>
            <hr class="mt-4 border-gray-500">
            <p class="mt-4 text-base font-bold text-gray-900 dark:text-gray-100">Detail:</p>
            <p class="mt-2 pl-4 text-base text-gray-900 dark:text-gray-100">{{ $product->description }}</p>
        </div>

        <div class="col-start-1 md:col-start-7 col-span-8 md:col-span-2">
            <form class="p-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg" wire:submit="addToCart">
                <livewire:components.quantity-button :$quantity key="{{ now() }}"/>

                <button type="submit" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 bg-gradient-to-r from-sky-500 to-indigo-500 hover:bg-gradient-to-r from-sky-600 to-indigo-600 px-8 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to cart</button>
            </form>
        </div>
    </div>
</div>

<div class="w-full">
    <div class="p-4 sm:p-8 grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="flex justify-center">
            <div class="h-full max-w-48 overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $product->attachment) }}" class="h-full w-full object-cover object-center">
            </div>
        </div>
        <div class="col-start-1 md:col-start-2 col-span-2">
            <h2 class="text-xl tracking-tight text-gray-900 dark:text-gray-100">{{ $product->name }}</h2>
            <h1 class="mt-4 text-2xl tracking-tight text-gray-900 dark:text-gray-100">{{ Str::price($product->price) }}</h1>
        </div>
        <div class="flex justify-center col-span-2">
            <livewire:components.quantity-button :$quantity :id="$cartItem->id" key="{{ now() }}" />
            <livewire:components.delete-button :id="$cartItem->id" key="{{ now() }}" />
        </div>
    </div>
</div>

<x-app-layout>
    <livewire:components.notification />

    <div class="relative mx-auto mt-20 w-full max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @foreach ($products as $product)
                <div class="group">
                    <a href="{{ url('/catalog/' . $product->id) }}" class="group">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="{{ asset('storage/' . $product->attachment) }}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                    </a>
                    <div class="flex justify-between">
                        <a href="{{ url('/catalog/' . $product->id) }}" class="group">
                            <div class="mt-4 ">
                                <h3 class="text-sm text-gray-700 dark:text-white">{{ $product->name }}</h3>
                                <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $product->price }}</p>
                            </div>
                        </a>
                        <livewire:components.add-button :id="$product->id" key="{{ now() }}" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>


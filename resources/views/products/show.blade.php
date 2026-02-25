<x-app-layout>
    <x-container class="px-4 py-4">


        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse ">
                <li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-body hover:text-purple-700">
                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m9 5 7 7-7 7" />
                        </svg>
                        <a href="{{ route('families.show', $product->subcategory->category->family->id) }}"
                            class="inline-flex items-center text-sm font-medium text-body hover:text-purple-700">
                            {{ $product->subcategory->category->family->name }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m9 5 7 7-7 7" />
                        </svg>
                        <a href="{{ route('categories.show', $product->subcategory->category->id) }}"
                            class="inline-flex items-center text-sm font-medium text-body hover:text-purple-700">
                            {{ $product->subcategory->category->name }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m9 5 7 7-7 7" />
                        </svg>
                        <a href="{{ route('categories.show', $product->subcategory->category->id) }}"
                            class="inline-flex items-center text-sm font-medium text-body hover:text-purple-700">
                            {{ $product->subcategory->name }}
                        </a>
                    </div>
                </li>

            </ol>
        </nav>

    </x-container>

    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure class="mb-2">
                        <img src="{{ $product->image }}" class="aspect-[16/9] w-full object-cover object-center"
                            alt="">
                    </figure>
                    <div class="text-sm">
                        {{ $product->description }}
                    </div>
                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-600 mb-2">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-center space-x-2 mb-4">
                        <ul class="flex spacex-4 text-sm">
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                        </ul>

                        <p class="text-sm text-gray600">
                            4-7 (55)
                        </p>
                    </div>

                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        $ {{ $product->price }}
                    </p>

                    <div class="flex space-x-6 items-center mb-6">
                        <button class="btn btn-gray">
                            -
                        </button>
                        <span>
                            1
                        </span>
                        <button class="btn btn-gray">
                            +
                        </button>
                    </div>

                    <button class="btn btn-purple w-full mb-6">
                        Agregar al carrito
                    </button>

                    <div class="text-gray-700 flex items-center space-x-4">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p>
                            servicio a domicilio
                        </p>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
    </x-container>
</x-app-layout>

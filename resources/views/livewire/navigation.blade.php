<div>
    <header class="bg-purple-600">
        <x-container class="px-4 py-4">
            <div class="flex justify-between space-x-8 items-center">

                <button class="text-xl md:text-2xl lg:text-3xl">
                    <i class="fas fa-bars text-white"></i>
                </button>

                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-xl md:text-2xl lg:text-3xl leading-4 md:leading-6 font-semibold">
                            Ecommerce
                        </span>
                        <span class="text-xs">
                            Tienda online
                        </span>
                    </a>
                </h1>
                <div class="flex-1 hidden md:block">
                    <x-input class="w-full" placeholder="Buscar por producto, tienda o marca" />
                </div>
                <div class="flex items-centerspace-x-8">
                    <button class="text-xl md:text-2xl lg:text-3xl">
                        <i class="fas fa-user text-white"></i>
                    </button>

                    <button class="text-xl md:text-2xl lg:text-3xl">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4 md:hidden">
                <x-input class="w-full" placeholder="Buscar por producto, tienda o marca" />
            </div>
        </x-container>
    </header>
</div>

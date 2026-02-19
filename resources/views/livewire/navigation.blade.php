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

    <div class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10">
    </div>

    <div class="fixed top-0 left-0 z-20">
        <div class="flex">
            <div class="w-screen sm:w-80 h-screen bg-white">
                <div class="px-4 py-3 bg-purple-600 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            !Hola!
                        </span>
                        <button>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($families as $family)
                            <li wire:mouseover="$set('family_id', {{ $family->id }})">
                                <a href=""
                                    class="flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-purple-200">
                                    {{ $family->name }}

                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <div class="h-[calc(100vh-52px)] overflow-auto bg-white px-6 py-8">

                    <div class="mb-8 flex justify-between items-center">
                        <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                            {{ $this->familyName }}
                        </p>

                        <a href="" class="btn btn-purple">
                            Ver Todo
                        </a>
                    </div>

                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach ($this->categories as $category)
                            <li>
                                <a href="" class="text-purple-600 font-semibold text-lg">
                                    {{ $category->name }}
                                </a>
                                <ul class="mt-4 space-y-2">
                                    @foreach ($category->subcategories as $subcategory)
                                        <li>
                                            <a href="" class="text-sm text-gray-700 hover:text-purple-600">
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <form wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white text-gray-700 cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen

                    <input type="file" class="hidden" wire:model="image" accept="image/*">
                </label>
            </div>
            <img src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt=""
                class="aspect-[16/9] object-cover object-center w-full">
        </figure>

        <x-validation-errors class="mb-4" />

        <div class="card">
            <div class="mb-4">
                <x-label class="mb-1">
                    Codigo
                </x-label>
                <x-input wire:model="productEdit.sku" class="w-full" placeholder="Ingrese el código del producto" />
            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre
                </x-label>
                <x-input wire:model="productEdit.name" class="w-full" placeholder="Ingrese el nombre del producto" />
            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Descripción
                </x-label>
                <x-text-area rows="4" wire:model="productEdit.description" class="w-full"
                    placeholder="Ingrese la descripción del producto">
                </x-text-area>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Familia
                </x-label>
                <x-select class="w-full" wire:model.live="family_id">
                    <option value="" disabled>
                        Seleccione una familia
                    </option>
                    @foreach ($this->families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Categorias
                </x-label>
                <x-select wire:model.live="category_id" class="w-full">
                    <option value="" disabled>
                        Seleccione una categoria
                    </option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Sub Categorias
                </x-label>
                <x-select wire:model.live="productEdit.sub_category_id" class="w-full">
                    <option value="" disabled>
                        Seleccione una subcategoria
                    </option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Precio
                </x-label>
                <x-input type="number" step="0.01" wire:model="productEdit.price" class="w-full"
                    placeholder="Ingrese el precio del producto" />
            </div>
            <div class="flex justify-end">
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </div>
    </form>
</div>

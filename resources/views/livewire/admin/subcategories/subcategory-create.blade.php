<div class="card">
    <form wire:submit.prevent="save" class="p-4">

        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label class="mb-2">
                Familias
            </x-label>

            <x-select class="w-full" wire:model.live="subcategory.family_id">
                <option value="" disabled>Selecione una familia</option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}" @selected(old('family_id') == $family->id)>
                        {{ $family->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">

            <x-label class="mb-2">
                Seleccionar categoria
            </x-label>
            <x-select name="category_id" class="w-full" wire:model.live="subcategory.category_id">
                <option value="" disabled>Seleccione una categoria</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Nombre de la subcategoria
            </x-label>
            <x-input class="w-full" value="{{ old('name') }}" placeholder="Ingrese el nombre de la subcategoria"
                wire:model="subcategory.name" />
        </div>
        <div class="flex justify-end">
            <x-button class="mt-4">
                Guardar
            </x-button>
        </div>

    </form>

</div>

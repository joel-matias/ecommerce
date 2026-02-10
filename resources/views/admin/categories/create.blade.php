<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categories',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">

                <x-validation-errors class="mb-4" />

                <x-label class="mb-2">
                    Seleccionar familia
                </x-label>
                <x-select name="family_id" class="w-full">
                    <option value="">Sin familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}" @selected(old('family_id') == $family->id)>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre de la categoria
                </x-label>
                <x-input class="w-full" name="name" value="{{ old('name') }}"
                    placeholder="Ingrese el nombre de la categoria" />
            </div>
            <div class="flex justify-end">
                <x-button class="mt-4">
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>

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
        'name' => $category->name,
    ],
]">

    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">

                <x-validation-errors class="mb-4" />

                <x-label class="mb-2">
                    Seleccionar familia
                </x-label>
                <x-select name="family_id" class="w-full">
                    <option value="">Sin familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}" @selected(old('family_id', $category->family_id) == $family->id)>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre de la categoria
                </x-label>
                <x-input class="w-full" name="name" value="{{ old('name', $category->name) }}"
                    placeholder="Ingrese el nombre de la categoria" />
            </div>
            <div class="flex justify-end">
                <x-danger-button class="mt-4" onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>
                <x-button class="mt-4 ml-2">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                // document.getElementById('delete-form').submit();

                Swal.fire({
                    title: "Estas Seguro?",
                    text: "No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire({
                        //     title: "Eliminado!",
                        //     text: "La familia ha sido eliminada.",
                        //     icon: "success"
                        // });
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>

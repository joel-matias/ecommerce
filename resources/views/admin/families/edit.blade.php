<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Families',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.families.update', $family) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre de la familia
                </x-label>
                <x-input class="w-full" name="name" value="{{ old('name', $family->name) }}"
                    placeholder="Ingrese el nombre de la familia" />
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

    <form action="{{ route('admin.families.destroy', $family) }}" method="POST" id="delete-form">
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

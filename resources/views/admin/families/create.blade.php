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
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.families.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre de la familia
                </x-label>
                <x-input class="w-full" name="name" value="{{ old('name') }}"
                    placeholder="Ingrese el nombre de la familia" />
            </div>
            <div class="flex justify-end">
                <x-button class="mt-4">
                    Guardar
                </x-button>
            </div>
        </form>

    </div>
</x-admin-layout>

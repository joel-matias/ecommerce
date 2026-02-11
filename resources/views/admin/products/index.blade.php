<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.products.create') }}" class="btn btn-blue">
            Nuevo
        </a>
    </x-slot>

    @if ($products->count())
        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            SKU
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-neutral-primary">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $product->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->sku }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->price }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-sm text-blue-500 hover:text-blue-700">
                                    Editar
                                </a>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @else
        <div class="flex items-start sm:items-center p-4 text-sm text-blue-800 rounded-base bg-blue-50" role="alert">
            <svg class="w-4 h-4 me-2 shrink-0 mt-0.5 sm:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p><span class="font-medium me-1">Todavia no hay subcategorias de productos registradas</span></p>
        </div>
    @endif
</x-admin-layout>

@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'icon' => 'fa-solid fa-cog',
            'name' => 'Opciones',
            'route' => route('admin.options.index'),
            'active' => request()->routeIs('admin.options.*'),
        ],
        [
            'icon' => 'fa-solid fa-users',
            'name' => 'Families',
            'route' => route('admin.families.index'),
            'active' => request()->routeIs('admin.families.*'),
        ],
        [
            'icon' => 'fa-solid fa-list',
            'name' => 'Categories',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],
        [
            'icon' => 'fa-solid fa-tags',
            'name' => 'Subcategories',
            'route' => route('admin.subcategories.index'),
            'active' => request()->routeIs('admin.subcategories.*'),
        ],
        [
            'icon' => 'fa-solid fa-box',
            'name' => 'Productos',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ],
        [
            'icon' => 'fa-solid fa-images',
            'name' => 'Portadas',
            'route' => route('admin.covers.index'),
            'active' => request()->routeIs('admin.covers.*'),
        ],
    ];
@endphp

<aside id="top-bar-sidebar"
    class="fixed left-0 z-40 w-64 h-[100dvh] top-16 transition-transform -translate-x-full sm:translate-x-0"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white border-e border-default">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-gray-200 group rounded-lg {{ $link['active'] ? 'bg-gray-200' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }} text-gray-500"></i>
                        </span>
                        <span class="ml-2">
                            {{ $link['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

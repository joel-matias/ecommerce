<div>
    <section class="roudend-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones
                </h1>

                <x-button wire:click="$set('openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>
        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="absolute -top-3 px-3 bg-white">
                            <span>
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- Valores --}}
                        <div class="flex flex-wrap">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span
                                            class="bg-gray-100 border border-default-medium border-gray-950 text-heading text-xs font-medium px-1.5 py-0.5 mr-2 rounded-lg">
                                            {{ $feature->description }}
                                        </span>
                                    @break

                                    @case(2)
                                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                            style="background-color: {{ $feature->value }}"></span>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name='title'>
            Crear nueva opción
        </x-slot>

        <x-slot name='content'>
            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6 mb-4 ">
                <div>
                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input wire:model="newOption.name" class="w-full" placeholder="Por ejemplo: Tamaño, Color" />
                </div>

                <div>
                    <x-label class="mb-1">
                        Tipo
                    </x-label>

                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>

            </div>

            <div class="flex item-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">
                    Valores
                </span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption['features'] as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="features-{{ $index }}">
                        <div class="absolute -top-2 px-4 bg-white">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-1">
                                    Valor
                                </x-label>


                                @switch($newOption['type'])
                                    @case(1)
                                        <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                            placeholder="Ingrese el valor de la opción" />
                                    @break

                                    @case(2)
                                        <div
                                            class="flex border border-gray-300 h-[42px] rounded-md items-center justify-between px-3">
                                            {{ $newOption['features'][$index]['value'] ?: 'Seleccione un color' }}
                                            <input type="color"
                                                wire:model.live="newOption.features.{{ $index }}.value">
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <div>
                                <x-label class="mb-1">
                                    Descripción
                                </x-label>
                                <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full"
                                    placeholder="Ingrese una descripción" />

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end">
                <x-button wire:click="addFeature" class="me-2">
                    Agregar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name='footer'>
            <button class="btn btn-blue" wire:click="addOption">
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>
</div>

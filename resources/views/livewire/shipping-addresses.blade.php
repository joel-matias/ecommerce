<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">

        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">Direcciones de envio guardadas</h2>
        </header>

        <div class="p-4">

            @if ($newAddress)
                <div class="grid grid-cols-4 gap-4">
                    {{-- Tipo --}}
                    <div class="col-span-1">
                        <x-select wire:model="createAddress.type">
                            <option value="">Tipo de direccion</option>
                            <option value="1">Domicilio</option>
                            <option value="2">Oficina</option>
                        </x-select>
                    </div>
                    {{-- Descripcion --}}
                    <div class="col-span-3">
                        <x-input type="text" placeholder="Nombre de la direccion" class="w-full"
                            wire:model="createAddress.description" />
                    </div>
                    {{-- Colonia --}}
                    <div class="col-span-2">
                        <x-input type="text" placeholder="Colonia" class="w-full"
                            wire:model="createAddress.district" />
                    </div>
                    {{-- Referencia --}}
                    <div class="col-span-2">
                        <x-input type="text" placeholder="Referencia" class="w-full"
                            wire:model="createAddress.reference" />
                    </div>
                </div>

                <hr class="my-4">

                <div>
                    <p class="font-semibold mb-2">
                        Quien recibira el pedido
                    </p>
                    <div class="flex space-x-2 mb-4">
                        <label class="flex items-center">
                            <input type="radio" value="1" class="mr-1">
                            Sere Yo
                        </label>
                        <label class="flex items-center">
                            <input type="radio" value="2" class="mr-1">
                            Otra Persona
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <x-input class="w-full" placeholder="Nombres" />
                    </div>
                    <div>
                        <x-input class="w-full" placeholder="Apellidos" />
                    </div>
                    <div>
                        <div class="flex space-x-2">
                            <x-select>
                                @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                    <option value="{{ $item->value }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input class="w-full" placeholder="Numero de Documento" />
                        </div>
                    </div>
                    <div>
                        <x-input class="w-full" placeholder="Telefono" />
                    </div>
                    <div>
                        <button class="btn btn-outline-gray w-full">
                            Cancelar
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-purple w-full">
                            Guardar
                        </button>
                    </div>
                </div>
            @else
                @if ($addresses->count())
                @else
                    <p class="text-center">No se han encontrado direcciones</p>
                @endif
                <button class="btn btn-outline-gray w-full flex items-center justify-center mt-4"
                    wire:click="$set('newAddress', true)">
                    Agregar
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>
            @endif

        </div>
    </section>
</div>

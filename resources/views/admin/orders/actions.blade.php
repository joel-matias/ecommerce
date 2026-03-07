<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button class="underline text-blue-500 hover:no-underline" wire:click="markAsProcessing({{ $order->id }})">
                Listo para despachar
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button wire:click="assignDriver({{ $order->id }})" class="underline text-blue-500 hover:no-underline">
                Asignar repartidor
            </button>
        @break

        @default
    @endswitch

    <button class="underline text-blue-500 hover:no-underline">
        Cancelar
    </button>
</div>

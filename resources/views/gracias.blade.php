<x-app-layout>
    <div class="pt-12 max-w-4xl mx-auto">
        <img src="https://d1ih8jugeo2m5m.cloudfront.net/2024/01/gracias-por-tu-compra-minimalista.jpg" class="w-full"
            alt="">

        @if (session('niubiz'))
            @php

                $response = session('niubiz')['response'];

            @endphp
            <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                <p class="mb-4">
                    {{ $response['dataMap']['ACTION_DESCRIPTION'] }}
                </p>
                <p>
                    <b>Numero de pedido:</b>
                    {{ $response['order']['purchaseNumber'] }}
                </p>
                <p>
                    <b>Fecha y hora del pedido:</b>
                    {{ \Carbon\Carbon::createFromTimestampMs($response['header']['ecoreTransactionDate'])->format('d-m-Y H:i:s') }}
                </p>
                <p>
                    <b>Tarjeta:</b>
                    {{ $response['dataMap']['CARD'] }} ({{ $response['dataMap']['BRAND'] }})
                </p>
                <p>
                    <b>Importe:</b>
                    {{ $response['order']['amount'] }}
                    {{ $response['order']['currency'] }}

                </p>
            </div>
        @endif
    </div>

</x-app-layout>

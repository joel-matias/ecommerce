<x-app-layout>
    <div class="-mb-16 text-gray-700" x-data="{
        pago: 1
    }">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] px-4 py-12 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="text-2xl font-semibold mb-2">Pago</h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" value="1" x-model="pago">
                                    <span class="ml-2">
                                        Tarjeta de debito/credito
                                    </span>
                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>
                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago == 1"
                                    x-cloak>
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">Luego de hacer click en paga ahora se abrira el checkout de Niubiz
                                        para completar
                                        tu compra de forma segura</p>
                                </div>
                            </li>
                            <li>
                                <label class="p-4 flex items-center border-top border-gray-400">
                                    <input type="radio" value="2" x-model="pago">
                                    <span class="ml-2">
                                        Deposito bancario
                                    </span>
                                </label>
                                <div class="p-4 bg-gray-100 flex justify-center" x-show="pago == 2">
                                    <div>
                                        <p>1. Pago por depósito o transferencia bancaria</p>
                                        <p>- NU: 912-366481231-12</p>
                                        <p>- Razon social: Ecommerce S.A de C.V</p>
                                        <p>- RFC: 12312312</p>
                                        <p>Enviar el comprobante de pago a 952712567</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <ul class="space-y-4 mb-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-16 aspect-square" src="{{ $item->options->image }}" alt="">
                                    <div
                                        class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                        <span class="text-white font-semibold">{{ $item->qty }}</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p>
                                        {{ $item->name }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p>
                                        $ {{ $item->price }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between">
                        <p>Subtotal</p>
                        <p>{{ Cart::instance('shopping')->subtotal() }}</p>
                    </div>

                    <div class="flex justify-between">
                        <p>Precio envio
                            <i class="fas fa-info-circle" title="El precio de envio es de $100"></i>
                        </p>
                        <p>$ 100.00</p>
                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>
                        <p>
                            $ {{ Cart::instance('shopping')->subtotal() + 100 }}
                        </p>
                    </div>
                    <div>
                        <button class="btn btn-purple w-full" onclick="VisanetCheckout.open();">
                            Finalizar pedido
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {

                let purchasenumber = Math.floor(Math.random() * 1000000000);
                let amount = {{ $amount }}

                VisanetCheckout.configure({
                    sessiontoken: '{{ $session_token }}',
                    channel: 'web',
                    merchantid: "{{ config('services.niubiz.merchant_id') }}",
                    purchasenumber: purchasenumber,
                    amount: amount,
                    expirationminutes: '20',
                    timeouturl: 'about:blank',
                    merchantlogo: 'img/comercio.png',
                    formbuttoncolor: '#000000',
                    action: "{{ route('checkout.paid') }}?amount=" + amount + "&purchaseNumber=" +
                        purchasenumber,
                    complete: function(params) {
                        alert(JSON.stringify(params));
                    }
                });
            })
        </script>
    @endpush
</x-app-layout>

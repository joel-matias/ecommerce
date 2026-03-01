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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque nobis, exercitationem corporis
                        eius
                        sunt magnam quasi maiores temporibus neque possimus delectus architecto labore nihil. Aliquam
                        numquam cumque sit hic ratione.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">

        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">Direcciones de envio guardadas</h2>
        </header>

        <div class="p-4">
            @if ($addresses->count())
            @else
                <p class="text-center">No se han encontrado direcciones</p>
            @endif
        </div>
    </section>
</div>

<div>
    <section class="roudend-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <h1 class="text-lg font-semibold text-gray-700">
                Opciones
            </h1>
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
</div>

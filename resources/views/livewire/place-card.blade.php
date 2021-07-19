<div>

    <div wire:ignore.self>
        @if (isset($message))
            <span class="text-green-600 font-bold cursor-pointer sp-message" onclick="hideMessage(this)"><span
                    class="fas fa-check"></span> {{ $message }}</span>
        @endif
        @if (!$places->count())
            <h1 class="mt-8 text-center uppercase text-xl font-bold">No se ha encontrado ninguna sucursal</h1>
        @endif
        <h1 class="font-bold uppercase text-2xl text-center">{{ $title }}</h1>
        <div class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-1 bg-blue-500 h-72 bg-opacity-20 rounded-md relative"
            id="div-places">
            <div wire:click="toggle"
                class="cursor-pointer mx-1 w-8 h-8 rounded-full flex items-center justify-center bg-gray-200 absolute right-2 top-2">
                <span class="fas {{ $button }} "></span>
            </div>
            @if ($places->count())
                @foreach ($places as $place)
                    <div class="flip-container " ontouchstart="this.classList.toggle('hover');">
                        <div class="flipper  p-1 flex-1 justify-center">
                            {{-- Parte de atrás con los detalles --}}
                            <div class="  shadow-xl m-2 p-1 px-2 rounded-lg bg-white  back absolute">
                                <div class="absolute  top-2 right-2 block ">
                                    @livewire('edit-place', ['place_id' => $place->id], key($place->id))
                                    @if ($place->id != 1)
                                        <span class="{{ $icon }} text-red-400  cursor-pointer mx-1"
                                            onclick="confirm('{{ $confirm }}') || event.stopImmediatePropagation()"
                                            wire:click="softdelete('{{ $place->slug }}')"></span>
                                    @endif
                                </div>
                                <div class="action">
                                    <div class="flex h-1/3  items-center  ">

                                        <div
                                            class="m-3 w-20 h-20 rounded-full shadow-xl flex items-center justify-center">
                                            <span class="fas fa-store-alt text-5xl text-blue-400 "></span>
                                        </div>

                                        <div class="mx-2">
                                            <span class=" font-bold text-2xl">{{ $place->name }}</span>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="space-y-2">
                                        <x-input_text name='' label='Teléfono' :oldValue="$place->phone" type="text"
                                            :placeholder="$place->phone" readonly model="phone" />
                                        <x-input_text name='' label='Ubicación' :oldValue="$place->phone" type="text"
                                            :placeholder="$place->location" readonly model="location" />
                                    </div>
                                    <hr class="my-2">
                                    <div class=" flex justify-center space-x-3">
                                        <span class="font-bold bg-gray-200 px-2 p-1 rounded-xl">Productos: <span
                                                class="font-normal">{{ $place->products()->count() }}</span></span>
                                        <span class="font-bold bg-gray-200 px-2 p-1 rounded-xl">Facturas: <span
                                                class="font-normal">{{ $place->invoices()->count() }}</span></span>
                                    </div>
                                </div>
                            </div>
                            {{-- Parte frontal con nombre e icono --}}
                            <div class="flex rounded-xl items-center bg-white justify-center  front mt-2"
                                style="height: 16.9rem">

                                <div class=" mx-auto">
                                    <div
                                        class="m-3 w-20 h-20 rounded-full shadow-xl flex items-center justify-center mx-auto">
                                        <span class="fas fa-store-alt text-5xl text-blue-400 "></span>
                                    </div>
                                    <div class="">
                                        <span class=" font-bold text-2xl">{{ $place->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            @endif
        </div>
        <div class="my-2">
            {{ $places->links() }}
        </div>
    </div>
   
    <script>
       
    </script>

</div>

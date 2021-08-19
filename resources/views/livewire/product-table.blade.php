<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        <div class="flex justify-end w-full">
            <span class="fa {{ $button }} cursor-pointer text-2xl right-2" wire:click='toggle'></span>
        </div>
        @if ($products->count())
        @endif
        <div class="flex items-center lg:w-2/3 mx-auto ">
            {{-- Sección de añadir y subir --}}
            <div class=" w-full">
                <x-modal modalId="md_add">
                    @slot('title')
                        <span class="px-4 my-2 text-xl flex items-center rounded-full"><span
                                class="fas fa-plus font-bold mr-2"></span> <span class="hidden md:block">Nuevo</span> </span>
                    @endslot
                    <div class=" " id="div-add-product">
                        @livewire('add-product')
                    </div>
                    <x-slot name="excel">
                        {{-- Sección de filtrado --}}
                        <div class="flex mx-auto pr-1 pb-4 ">
                            <div class=" w-2/6 lg:w-48 mx-1">
                                <x-jet-label for="type" class="text-lg text-left">Tipo</x-jet-label>
                                <select
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm  w-full overflow-auto "
                                    name="" id="" wire:model="type">
                                    <option value="1">Producto</option>
                                    <option value="0">Servicio</option>
                                </select>
                            </div>
                            <div class=" w-2/6 lg:w-48 mx-1">
                                <x-jet-label for="place_id" class="text-lg text-left">Sucursal</x-jet-label>
                                <select
                                class="border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full overflow-auto "
                                name="" id="" wire:model="place_id">
                                @foreach ($places as $place)
                                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                                @endforeach
        
                            </select>
                            </div>
                            <div class=" w-2/6 lg:w-28 mx-1 ">
                                <x-jet-label for="cant" class="text-lg text-left">Mostrar</x-jet-label>
                                <select
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm  w-full overflow-auto text-left"
                                    name="" id="" wire:model="amount">
                                    <option value="5">5/{{ $products->total() }}</option>
                                    <option value="10">10/{{ $products->total() }}</option>
                                    <option value="25">25/{{ $products->total() }}</option>
                                    <option value="{{ $products->total() }}">Todos</option>
                                </select>
                            </div>
                           
                        </div>
                        {{-- Fin de sección de filtrado --}}
                    </x-slot>
                </x-modal>
            </div>
            {{-- Fin de sección de añadir y subir --}}


        </div>

        {{-- Barra de Búsqueda --}}
        <div class="  lg:w-2/3 mx-auto mt-1 flex items-center justify-center ">
            <div class="flex border border-1 border-blue-200 rounded-md items-center w-11/12">
                <span
                    class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-1/6">Búsqueda:</span>
                <input name="search"
                    class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 lg:w-5/6 overflow-auto"
                    id="search" type="search" placeholder="Buscar producto" value="{{ old('search') }}"
                    wire:model.defer="search" />
            </div>
            <div class="hidden md:inline-block">
                <span class="fas fa-search ml-2 text-xl cursor-pointer" wire:click="search" id="sp-search"></span>
            </div>
        </div>
        {{-- Fin de barra de búsqueda --}}

        {{-- Contenedor de la tabla --}}
        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 28rem">
                    <x-jet-input-error for="cant" class="text-center text-xl"></x-jet-input-error>

                    <table class="  lg:w-2/3 mx-auto">
                        <thead>
                            <tr class="bg-gray-900 text-base font-bold text-white text-left " 
                                style="font-size: 0.9674rem; ">
                                <th class="px-4 py-2 cursor-pointer   sticky top-0 bg-gray-900" wire:clicK="order('name')" >Nombre
                                    <div class="hidden md:inline-block"><span
                                            class="hidden fas {{ $order == 'name' ? $icon_order : 'fa-sort' }} "></span>
                                    </div>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer    sticky top-0 bg-gray-900" wire:clicK="order('cost')">Costo
                                    <div class="hidden md:inline-block"><span
                                            class="fas {{ $order == 'cost' ? $icon_order : 'fa-sort' }} hidden lg:inline-block"></span>
                                    </div>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer   sticky top-0 bg-gray-900" wire:clicK="order('price')">Precio
                                    <div class="hidden md:inline-block"><span
                                            class="fas {{ $order == 'price' ? $icon_order : 'fa-sort' }} hidden lg:inline-block"></span>
                                    </div>
                                </th>
                                @if ($type == 1)
                                    <th class="px-4 py-2  text-center cursor-pointer  sticky top-0 bg-gray-900" wire:clicK="order('stock')">Stock
                                        <div class="hidden md:inline-block"> <span
                                                class="fas {{ $order == 'stock' ? $icon_order : 'fa-sort' }} hidden lg:inline-block"></span>
                                        </div>
                                    </th>
                                @endif
                                <th class="px-4 py-2  text-center cursor-pointer sticky top-0 bg-gray-900">Categoría</th>
                                <th class="py-2  text-center sticky top-0 bg-gray-900" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900 ">
                            @foreach ($products->chunk(50) as $array)
                                @foreach ($array as $product)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-1 flex items-center">
                                            @if ($is_active == 1 && Auth::user()->id==1)
                                                <x-modal modalId="{{ $product->id }}">
                                                    <x-slot name="title"><span
                                                            class="fas fa-plus text-gray-900 mr-4"></span></x-slot>
                                                    <div>
                                                        <h1 class="font-bold text-lg text-center">Añadir</h1>
                                                        <form action="javascript:void(0)">
                                                            <x-input_text type="number" name="cant" model="cant"
                                                                label="Cantidad" placeholder="Cantidad a añadir"
                                                                :oldValue="''"></x-input_text>
                                                            <div class="flex justify-end">
                                                                <x-jet-button class="mt-2 " onclick="confirm('¿Desea sumar estos productos al inventario?')|| event.stopImmediatePropagation()"
                                                                    wire:click="add('{{ $product->slug }}')">Añadir
                                                                </x-jet-button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </x-modal>
                                            @endif

                                            {{ $product->name }}
                                        </td>
                                        <td class="px-4 py-1 text-center w-24">${{ $product->cost }}</td>
                                        <td class="px-4 py-1 text-center">${{ $product->price }}</td>
                                        @if ($type == 1)
                                            <td class="px-4 py-1 text-center">{{ $product->stock }}</td>
                                        @endif
                                        <td class="px-4 py-1 text-center">{{ $product->category->name }}</td>
                                        <td class=" py-2 text-center">
                                            <x-modal modalId="edit{{ $product->id }}">
                                                <x-slot name="title">
                                                    <span class="fas fa-pen mx-2"></span>
                                                </x-slot>
                                                @livewire('edit-product', ['product' => $product],
                                                key($product->id.$product->stock))
                                            </x-modal>
                                        </td>
                                        <td class=" py-2 text-center">
                                            <span class="fas {{ $icon }} cursor-pointer"
                                                onclick="confirm('{{ $confirm }}')|| event.stopImmediatePropagation()"
                                                wire:click="softdelete('{{ $product->slug }}')">
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $products->links() !!}
                    <x-jet-button wire:click="printCodes"><span class="fas fa-print"></span></x-jet-button>
                </div>
            </div>
        </div>
        {{-- Fin del contenedor de la tabla --}}
    </div>
    <style>
        thead tr th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        thead tr th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        tbody tr td:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 0px;
        }

        tbody tr td:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 0px;
        }


        tr:nth-child(2n) {
            background: #a3d1e0
        }

        tr:nth-child(2n+3) {
            background: #fff
        }

        table {
            transition: all 1s ease-in-out;
        }

    </style>
    <script>
        $('#search').on('keypress', function(e) {
            if (e.which == 13) {
                $('#sp-search').trigger('click');
            }
        });
        $('#search').change(function(e) {
            if ($.trim($('#search').val().length == 0)) {

                $('#sp-search').trigger('click');
            }
        });
    </script>
</div>

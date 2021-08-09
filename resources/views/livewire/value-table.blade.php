<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        <div class="flex justify-end w-full">
            <span class="fa {{ $button }} cursor-pointer text-2xl right-2" wire:click='toggle'></span>
        </div>
        @if ($products->count())
            <div class="absolute left-2">
                <x-jet-button wire:click="printCodes">Imprimir Códigos</x-jet-button>
            </div>
        @endif
        <div class=" mx-auto">
            <x-modal modalId="md_add">
                @slot('title')
                    <span class="px-4 my-2 text-xl"><span class="fas fa-plus font-bold "></span> Nuevo </span>
                @endslot
                <div class=" " id="div-add-product">
                    @livewire('add-product')
                </div>
                <x-slot name="excel">
                    @if (Auth::user()->id == 1)
                        <div class="flex items-center border border-1 border-blue-200 rounded-md pr-1 w-full">
                            <span
                                class="text-sm rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-3/6 md:w-2/6 hidden md:inline-block">Filtrar:</span>
                            
                            <select
                                class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm w-4/6 overflow-auto "
                                name="" id="" wire:model="type">
                                <option value="1">Producto</option>
                                <option value="0">Servicio</option>
                            </select>
                            <select
                                class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm w-4/6 overflow-auto "
                                name="" id="" wire:model="cant">
                                <option value="5">Ver 5</option>
                                <option value="10">Ver 10</option>
                                <option value="25">Ver 25</option>
                                <option value="{{$products->total()}}">Ver Todos</option>
                            </select>
                        </div>
                    @endif


                </x-slot>
            </x-modal>
        </div>

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

        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 34rem">
                    <table class="  lg:w-2/3 mx-auto">
                        <thead class="relative">
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">#</th>
                                <th class="px-4 py-2 cursor-pointer  sticky top-0 bg-gray-900" wire:clicK="order('name')">Nombre
                                    <div class="hidden md:inline-block"><span
                                            class="hidden fas {{ $order == 'name' ? $icon_order : 'fa-sort' }} "></span>
                                    </div>
                                </th>
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">Entrada</th>
                                <th class="px-4 py-2  text-center sticky top-0 bg-gray-900" >Salida</th>
                                    <th class="px-4 py-2  text-center cursor-pointer sticky top-0 bg-gray-900" wire:clicK="order('stock')">Valor</th>
                                <th class="px-4 py-2  text-center cursor-pointer sticky top-0 bg-gray-900">Categoría</th>

                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900">
                            
                            @foreach ($products->chunk(50) as $array)
                                @foreach ($array as $product)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-1 ">{{ $number++ }}</td>
                                        <td class="px-4 py-1 ">{{ $product->name }}</td>
                                        <td class="px-4 py-1 text-center ">
                                            ${{ floatval($product->cost * $product->stock) }}</td>
                                        <td class="px-4 py-1 text-center">
                                            ${{ floatval($product->price * $product->stock) }}</td>
                                        @if ($type == 1)
                                            <td class="px-4 py-1 text-center">
                                                ${{ floatval($product->price * $product->stock) - floatval($product->cost * $product->stock) }}
                                            </td>
                                        @endif
                                        <td class="px-4 py-1 text-center">{{ $product->category->name }}</td>

                                    </tr>
                                @endforeach
                            @endforeach
                           
                        </tbody>
                        @foreach ($products->chunk(50) as $product)
                        @foreach ($product as $item)
                            <div class="hidden"> {{ $cost += $item->cost * $item->stock }}</div>
                            <div class="hidden"> {{ $price += $item->price * $item->stock }}</div>
                        @endforeach
                        <tr class="bg-gray-900 text-base font-bold text-white">
                            <td class="px-4 py-1 text-center font-bold sticky bottom-0 bg-gray-900" colspan="2">TOTALES</td>
                            <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900">${{ $cost }}</td>
                            <td class="px-4 py-1 text-center  sticky bottom-0 bg-gray-900">${{ $price }}</td>
                            @if ($type == 1)
                                <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900">${{ $price - $cost }}</td>
                            @endif
                            <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900"></td>

                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
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

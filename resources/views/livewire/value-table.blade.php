<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">

        {{-- Controles de Filtro --}}
        <div class=" mx-auto lg:w-max">
            @if (Auth::user()->id == 1)
                <div class="flex mx-auto pr-1 pb-4 ">
                    <div class=" w-2/6 lg:w-48 mx-1">
                        <x-jet-label for="type" class="text-lg text-left">Tipo</x-jet-label>
                        <select
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm  w-full overflow-auto "
                            name="" id="" wire:model="type">
                            <option value="PRODUCTO">Producto</option>
                            <option value="SERVICIO">Servicio</option>
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
                            name="" id="" wire:model="cant">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="{{ $products->total() }}">Todos</option>
                        </select>
                    </div>
                   
                </div>
            @endif
        </div>
        {{-- Fin de controles de filtro --}}
        {{-- Barra de búsqueda --}}
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

                <div class="overflow-x-auto mt-3 select-none" style="height: 30rem">
                    <table class="  lg:w-2/3 mx-auto">
                        <thead class="relative">
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">#</th>
                                <th class="px-4 py-2 cursor-pointer  sticky top-0 bg-gray-900"
                                    wire:clicK="order('name')">Nombre
                                    <div class="hidden md:inline-block"><span
                                            class="hidden fas {{ $order == 'name' ? $icon_order : 'fa-sort' }} "></span>
                                    </div>
                                </th>
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">Entrada</th>
                                <th class="px-4 py-2  text-center sticky top-0 bg-gray-900">Salida</th>
                                <th class="px-4 py-2  text-center cursor-pointer sticky top-0 bg-gray-900"
                                    wire:clicK="order('stock')">Valor</th>
                                <th class="px-4 py-2  text-center cursor-pointer sticky top-0 bg-gray-900">Categoría
                                </th>

                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900">

                           @if ($products->count())
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
                                       <td class="px-4 py-1 text-center">
                                           ${{ floatval($product->price * $product->stock) - floatval($product->cost * $product->stock) }}
                                       </td>
                                   <td class="px-4 py-1 text-center">{{ $product->category->name }}</td>

                               </tr>
                           @endforeach
                       @endforeach
                           @else
                               <tr>
                                   <td colspan="6" class="font-bold text-xl uppercase text-center">
                                       No se encontraron registros
                                   </td>
                               </tr>
                           @endif

                        </tbody>
                        @foreach ($products->chunk(50) as $product)
                            @foreach ($product as $item)
                                <div class="hidden"> {{ $cost += $item->cost * $item->stock }}</div>
                                <div class="hidden"> {{ $price += $item->price * $item->stock }}</div>
                            @endforeach
                           
                        @endforeach
                        <tr class="bg-gray-900 text-base font-bold text-white">
                            <td class="px-4 py-1 text-center font-bold sticky bottom-0 bg-gray-900" colspan="2">
                                TOTALES</td>
                            <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900">${{ $cost }}</td>
                            <td class="px-4 py-1 text-center  sticky bottom-0 bg-gray-900">${{ $price }}
                            </td>
                                <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900">
                                    ${{ $price - $cost }}</td>
                            <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-900"></td>

                        </tr>
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $products->links() !!}
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

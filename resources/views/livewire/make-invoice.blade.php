<div>
    <div class="w-full text-center">
        <x-jet-input-error for="cant" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="price" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="discount" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="cashMoney" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="other" class="text-xl"></x-jet-input-error>
    </div>

    <div
        class="md:flex justify-between items-center px-4 md:w-11/12 lg:w-10/12 xl:w-2/3 mx-auto bg-gradient-to-b from-blue-50 to-blue-200 relative">
        <div class="absolute top-2 left-1/3 flex space-x-2 items-center">

            @if ($cotize == 0 && $tipos->count())
                <x-jet-input type="checkbox" value="1" id="is_ncf" wire:model="is_ncf"></x-jet-input>
                <x-jet-label for="is_ncf">NCF</x-jet-label>
            @endif
            @if ($is_ncf == 1)
                <x-input_select label="Tipo" name="typeFiscal" model="typeFiscal" oldValue="" placeholder="Tipo">
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->type }}">{{ $tipo->type }}</option>
                    @endforeach
                </x-input_select>
            @endif
        </div>
        <div class="md:w-max h-40 py-4 px-1 shadow-sm rounded-xl flex flex-col">
            <x-jet-label for="client_id" class="font-bold text-lg py-1 ">
                <span class="fas fa-pen text-blue-600 cursor-pointer text-xs hidden" id="hide_select"></span> Emitir
                a:
            </x-jet-label>
            <div class="flex space-x-3 items-center " id="div_select" wire:ignore>
                <div>
                    <select class="chosen-select client_id select2" data-placeholder="Selecciona un cliente"
                        wire:ignore.self>
                        <option value=""></option>
                        @foreach ($clients->chunk(50) as $array)

                            @foreach ($array as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <x-modal modalId="add_client">
                    <x-slot name="title">
                        <span class="fas fa-plus text-xl"></span>
                    </x-slot>
                    @livewire('add-client', key("1"))
                </x-modal>
            </div>
            <div class="pt-3 flex flex-col">
                <div class="-my-2">
                    <span class=" font-bold text-lg"><span class="fas fa-user mx-1"></span>
                        <input type="text" wire:model="name" readonly disabled
                            class="outline-none border-0 focus:border-0 focus:outline-none font-bold text-lg py-1 my-1 select-none cursor-default bg-transparent">
                </div>
                <div class="-my-2">
                    <span class=" font-bold text-lg"><span class="fas fa-phone mx-1"></span>
                        <input type="text" wire:model="phone" readonly disabled
                            class="outline-none border-0 focus:border-0 focus:outline-none font-bold text-lg py-1 my-1 select-none cursor-default bg-transparent">
                </div>
                </span>
            </div>
        </div>
        <div class="md:w-max flex flex-col mr-4">
            <span class="mb-2 font-bold text-xl">Doc. No. <span
                    class="underline">{{ str_pad(Auth::user()->place->invoices->count() + 1, 5, '0', STR_PAD_LEFT) }}</span></span>
            <span class="font-bold">{{ date('D d M Y') }}</span>
            <span class="font-bold">{{ date('H:i:s') }}</span>
            <hr class="my-2">

            <span class="font-bold">Cajero: </span></span>
            <span class="uppercase font-normal">{{ Auth::user()->name }}
        </div>
    </div>

    <div class=" py-8 px-4 md:w-11/12 lg:w-10/12 xl:w-2/3 mx-auto bg-gradient-to-t from-blue-50 to-blue-200"
        style="max-height: 70vh">
        <div class="">

            <div class="md:flex space-x-3 items-center w-full" wire:ignore>

                <div id="div_select" class="md:w-full">
                    <x-jet-label for="product_id">Producto</x-jet-label>
                    <select class="chosen-select product_id w-full select2" data-placeholder="Selecciona un producto"
                        id="product_id">
                        <option value=""></option>
                        @foreach ($products->chunk(50) as $array)
                            @foreach ($array as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->code }} - {{ $product->meta }} - ${{ $product->price }}
                                    ({{ $product->stock }}) -
                                    {{ $product->is_product == 1 ? 'P' : 'S' }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>


                <div class="flex space-x-2 items-center mt-2 md:mt-0">
                    <div class="lg:w-1/4">
                        <x-jet-label for="cant">Cantidad</x-jet-label>
                        <x-jet-input type="number" placeholder="Cantidad" wire:model.defer="cant"
                            class="py-0 w-full enter_input" max='5' name="cant">
                        </x-jet-input>

                    </div>
                    <div class="lg:w-1/4">
                        <x-jet-label for="price">Precio</x-jet-label>
                        <x-jet-input type="number" placeholder="Precio" wire:model.defer="price" class="py-0 w-full"
                            >
                        </x-jet-input>

                    </div>
                    @can('Descontar')
                        <div class="lg:w-1/4">
                            <x-jet-label for="discount">Descuento</x-jet-label>
                            <x-jet-input type="number" placeholder="Descuento" wire:model.defer="discount"
                                class="py-0 w-full enter_input">
                            </x-jet-input>

                        </div>
                    @endcan
                    <div class="lg:w-1/4 mt-4">
                        <x-jet-button class="py-1" wire:click="addDetail" id="addDetail"><span
                                class="fas fa-plus"></span>
                        </x-jet-button>
                    </div>
                </div>

            </div>
            <div class="">
                <div class="overflow-scroll relative" style="max-height:50vh">
                    <table class=" my-2 w-full  ">
                        <thead class=" ">
                            <tr class="bg-gray-900 text-base font-bold text-white text-left  "
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2   sticky top-0 bg-gray-900">Cant</th>
                                <th class="px-4 py-2 sticky top-0 bg-gray-900">Producto</th>
                                <th class="px-4 py-2  text-center sticky top-0 bg-gray-900">Precio</th>
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">ITBIS</th>
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">Subtotal</th>
                                <th class="px-4 py-2  text-center sticky top-0 bg-gray-900">Descuento</th>
                                <th class="px-4 py-2  text-center  sticky top-0 bg-gray-900">Total</th>
                                <th class="py-2  text-center sticky top-0 bg-gray-900" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900 overflow-auto ">
                            @if (count($list) > 0)
                                @foreach ($list as $item)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-2 max-w-16">{{ $item['cant'] }}</td>
                                        <td class="px-4 py-2 lg:w-72 lg:max-w-72">{{ $item['name'] }}</td>
                                        <td class="px-4 py-2 text-center">${{ sprintf('%0.2f', $item['price']) }}
                                        </td>
                                        <td class="px-4 py-2 text-center">${{ sprintf('%0.2f', $item['tax']) }}</td>
                                        <td class="px-4 py-2 text-center">${{ sprintf('%0.2f', $item['subtotal']) }}
                                        </td>
                                        <td class="px-4 py-2 text-center">${{ sprintf('%0.2f', $item['discount']) }}
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            ${{ sprintf('%0.2f', $item['total'] - $item['discount']) }}
                                        </td>
                                        <td class=" py-2 text-center">
                                            <span class="fas fa-pen text-blue-400 cursor-pointer"
                                                wire:click="charge('{{ $item['id'] }}')">
                                            </span>
                                        </td>
                                        <td class=" py-2 text-center">
                                            <span class="fas fa-times text-red-400 cursor-pointer"
                                                wire:click="getTotals(null, '{{ $item['id'] }}')"
                                                onclick="confirm('¿Desea borrar este producto?')|| event.stopImmediatePropagation()">
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>

                                </tr>
                                <tr
                                    class=" border-white hover:border-gray-200 py-4 text-base font-bold sticky bottom-0 bg-gray-600 text-white">
                                    <td class="px-4 py-1 max-w-16 text-center font-bold uppercase sticky bottom-0 bg-gray-600"
                                        colspan="3">Totales</td>
                                    <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-600">
                                        ${{ sprintf('%0.2f', $totales['tax']) }}</td>
                                    <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-600">
                                        ${{ sprintf('%0.2f', $totales['subtotal']) }}</td>
                                    <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-600">
                                        ${{ sprintf('%0.2f', $totales['discount']) }}</td>
                                    <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-600">
                                        ${{ sprintf('%0.2f', $totales['total']) }}</td>
                                    <td class="px-4 py-1 text-center sticky bottom-0 bg-gray-600" colspan="2"></td>

                                </tr>
                            @endif


                        </tbody>
                    </table>
                </div>

                <div class="py-2 flex justify-end mr-8 space-y-4">
                    @if ($cotize == 0)
                        <x-modal modalId="cobrar">
                            <x-slot name='title'>
                                <div
                                    class="font-bold text-lg flex items-center cursor-pointer bg-gray-900 text-white px-2  rounded-xl">
                                    <span class="fas fa-money mx-2"></span> Facturar
                                </div>
                            </x-slot>
                            <div>
                                <x-jet-label for="cashMoney">Efectivo</x-jet-label>
                                <x-jet-input type='number' placeholder="Efectivo" wire:model.defer="cashMoney"
                                    class="text-center mb-2" id="cash"></x-jet-input>

                                <x-jet-label for="other">Otro</x-jet-label>
                                <x-jet-input type='number' placeholder="otro" wire:model.defer="other"
                                    class="text-center mb-2" id="other"></x-jet-input>

                                <br>
                                <x-jet-label for="other">Vendedor</x-jet-label>
                                <select class="chosen-select w-52 select2" data-placeholder="Selecciona un vendedor"
                                    name="seller" id="seller" wire:model.defer="seller_id">
                                    <option value=""></option>
                                    @foreach ($seller as $salo)
                                        <option value="{{ $salo->id }}">{{ $salo->name }}</option>
                                    @endforeach
                                </select>
                                <br> <br>
                                <x-jet-button wire:click="facturar" id="btn-facturar">Cobrar</x-jet-button>
                            </div>
                        </x-modal>
                    @else
                        <div class="font-bold text-lg flex items-center cursor-pointer bg-gray-900 text-white px-2  rounded-xl"
                            wire:click="cotizar">
                            <span class="fas fa-money mx-2"></span> Cotizar
                        </div>
                    @endif
                </div>


            </div>
        </div>
        <script>
            /* No puedo pasar esta función al main porque tiene un método
                                    de Livewire @this.set() */
            /* Detecta la selección del cliente */
            $('.client_id').change(function(e) {
                var value = $('.client_id').select2("val");
                @this.set('client_id', value);
                $('#div_select').toggle('', false);
                $('#hide_select').show('', false)
            })
        </script>
    </div>

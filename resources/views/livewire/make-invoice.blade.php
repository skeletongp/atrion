<div>
    <div class="w-full text-center">
        <x-jet-input-error for="cant" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="price" class="text-xl"></x-jet-input-error>
        <x-jet-input-error for="discount" class="text-xl"></x-jet-input-error>
    </div>
   
    <div class="md:flex justify-between items-center px-4 lg:w-2/3 mx-auto bg-gradient-to-b from-blue-50 to-blue-200">
        <div class="md:w-max h-40 py-4 px-1 shadow-sm rounded-xl flex flex-col">
            <x-jet-label for="client_id" class="font-bold text-lg py-1 ">
                <span class="fas fa-pen text-blue-600 cursor-pointer text-xs hidden" id="hide_select"></span> Facturar
                a:
            </x-jet-label>
            <div class="flex space-x-3 items-center " wire:ignore>
                <div id="div_select">
                    <select class="chosen-select client_id" data-placeholder="Selecciona un cliente" wire:ignore.self>
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
            <span class="mb-2 font-bold text-xl">Factura No. <span
                    class="underline">{{ str_pad(Auth::user()->place->invoices->count() + 1, 5, '0', STR_PAD_LEFT) }}</span></span>
            <span class="font-bold">{{ date('D d M Y') }}</span>
            <span class="font-bold">{{ date('H:i:s') }}</span>
            <hr class="my-2">

            <span class="font-bold">Atiende: </span></span>
            <span class="uppercase font-normal">{{ Auth::user()->name }}
        </div>
    </div>
    
    <div class=" py-8 px-4 lg:w-2/3 mx-auto bg-gradient-to-t from-blue-50 to-blue-200 lg:h-96">
        <div class="">
           
            <div class="flex space-x-3 items-center w-full" wire:ignore>

                <div id="div_select" class="w-full">
                    <x-jet-label for="product_id">Producto</x-jet-label>
                    <select class="chosen-select product_id w-full" data-placeholder="Selecciona un producto" id="product_id">
                        <option value=""></option>
                        @foreach ($products->chunk(50) as $array)
                            @foreach ($array as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} - ${{ $product->price }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="lg:w-1/4">
                    <x-jet-label for="cant">Cantidad</x-jet-label>
                    <x-jet-input type="number" placeholder="Cantidad" wire:model.defer="cant" class="py-0 w-full enter_input" max='5' name="cant">
                    </x-jet-input>
                    
                </div>
                <div class="lg:w-1/4">
                    <x-jet-label for="price">Precio</x-jet-label>
                    <x-jet-input type="number" placeholder="Precio" wire:model.defer="price" class="py-0 w-full"
                        readonly>
                    </x-jet-input>
                   
                </div>
                @can('Descontar')
                    <div class="lg:w-1/4">
                        <x-jet-label for="discount">Descuento</x-jet-label>
                        <x-jet-input type="number" placeholder="Descuento" wire:model.defer="discount" class="py-0 w-full enter_input">
                        </x-jet-input>
                        
                    </div>
                @endcan
                <div class="lg:w-1/4 mt-4">
                    <x-jet-button class="py-1" wire:click="addDetail" id="addDetail"><span class="fas fa-plus"></span></x-jet-button>
                </div>

            </div>
            <div>
                <table class="table-auto  my-2 w-full mx-auto">
                    <thead>
                        <tr class="bg-gray-900 text-base font-bold text-white text-left" style="font-size: 0.9674rem">
                            <th class="px-4 py-2 cursor-pointer">Cant</th>
                            <th class="px-4 py-2 cursor-pointer">Producto</th>
                            <th class="px-4 py-2  text-center cursor-pointer">Precio</th>
                            <th class="px-4 py-2  text-center cursor-pointer">ITBIS</th>
                            <th class="px-4 py-2  text-center cursor-pointer">Subtotal</th>
                            <th class="px-4 py-2  text-center cursor-pointer">Descuento</th>
                            <th class="px-4 py-2  text-center cursor-pointer">Total</th>
                            <th class="py-2  text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-normal text-gray-900">
                        @if (count($list) > 0)
                            @foreach ($list as $item)
                                <tr
                                    class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                    <td class="px-4 py-2 max-w-16">{{ $item['cant'] }}</td>
                                    <td class="px-4 py-2 lg:w-72 lg:max-w-72">{{ $item['name'] }}</td>
                                    <td class="px-4 py-2 text-center">${{ $item['price'] }}</td>
                                    <td class="px-4 py-2 text-center">${{ $item['tax'] }}</td>
                                    <td class="px-4 py-2 text-center">${{ $item['subtotal'] }}</td>
                                    <td class="px-4 py-2 text-center">${{ $item['discount'] }}</td>
                                    <td class="px-4 py-2 text-center">${{ $item['total'] }}</td>
                                    <td class=" py-2 text-center">
                                        <span class="fas fa-pen text-blue-400 cursor-pointer"
                                            wire:click="charge('{{ $item['id'] }}')">
                                        </span>
                                    </td>
                                    <td class=" py-2 text-center">
                                        <span class="fas fa-times text-red-400 cursor-pointer"
                                            wire:click="remove('{{ $item['id'] }}')"
                                            onclick="confirm('¿Desea borrar este producto?')|| event.stopImmediatePropagation()">
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>

                            </tr>
                            <tr
                                class=" border-white hover:border-gray-200 py-4 text-base font-bold bg-gray-500 text-white">
                                <td class="px-4 py-1 max-w-16 text-center font-bold uppercase" colspan="3">Totales</td>
                                <td class="px-4 py-1 text-center">${{ $totales['tax'] }}</td>
                                <td class="px-4 py-1 text-center">${{ $totales['subtotal'] }}</td>
                                <td class="px-4 py-1 text-center">${{ $totales['discount'] }}</td>
                                <td class="px-4 py-1 text-center">${{ $totales['total'] }}</td>
                                <td class="px-4 py-1 text-center" colspan="2"></td>

                            </tr>
                        @endif


                    </tbody>
                </table>
                <div class="py-2 flex justify-end">
                    <span class="font-bold text-lg cursor-pointer bg-gray-900 text-white px-2  rounded-xl"
                        wire:click="facturar">
                        <span class="fas fa-money"></span> Facturar</span>
                </div>
                <span wire:click="prove" class="cursor-pointer">
                    Probar
                </span>
                
            </div>
        </div>
        <script>
            $("select").select2();
            $('#hide_select').hide('', false)
            $('.client_id').change(function(e) {
                var value = $('.client_id').select2("val");
                @this.set('client_id', value);
                $('#div_select').toggle('', false);
                $('#hide_select').show('', false)
            })
            $('.product_id').change(function() {
                var value = $('.product_id').select2("val");
                Livewire.emit('change', value);

            })
            $('#hide_select').click(function() {
                $('#div_select').toggle('', false)

                $('#hide_select').hide('', false)
            })
            $('.enter_input').on('keypress', function(e) {
                if (e.which == 13) {
                    $('#addDetail').trigger('click');
                    $('#product_id').select2('open');
                }
            })
        </script>

    </div>

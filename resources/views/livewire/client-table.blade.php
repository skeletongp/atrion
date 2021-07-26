<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        {{-- Btn Papelera --}}
        <div class="flex justify-end w-full">
            <span class="fa {{ $button }} cursor-pointer text-2xl w-max " wire:click='toggle'></span>
        </div>
        {{-- Btn  nuevo Usuario --}}
        <div class=" mx-auto">
            <x-modal modalId="md_add">
                @slot('title')
                    <span class="px-4 my-2"><span class="fas fa-plus font-bold"></span> Nuevo Cliente</span>
                @endslot
                <div class=" select-none ">
                    @livewire('add-client')
                </div>

            </x-modal>
        </div>

        <div class="  lg:w-2/3 mx-auto my-4 flex items-center justify-center ">
            <div class="flex border border-1 border-blue-200 rounded-md items-center w-11/12">
                <span
                    class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-1/6">Búsqueda:</span>
                <input name="search"
                    class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 lg:w-5/6 overflow-auto"
                    id="search" type="search" placeholder="Buscar producto" value="{{ old('search') }}"
                    wire:model.defer="search" />
            </div>
            <div>
                <span class="fas fa-search ml-2 text-xl cursor-pointer" wire:click="search" id="sp-search"></span>
            </div>
        </div>

        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 34rem">
                    <table class="table-auto  lg:w-2/3 mx-auto table">
                        <thead>
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2 cursor-pointer text-center" wire:clicK="order('rnc')">RNC
                                    <span class="fas {{ $order == 'rnc' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2 cursor-pointer" wire:clicK="order('name')">Nombre
                                    <span class="fas {{ $order == 'name' ? $icon_order : 'fa-sort' }}"></span>
                                </th>

                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('phone')">Teléfono
                                    <span class="fas {{ $order == 'phone' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2 text-center cursor-pointer" wire:clicK="order('debt')">Deuda
                                    <span class="fas {{ $order == 'debt' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center ">Facturas

                                </th>
                                <th class="px-4 py-2  text-center ">Cuentas

                                </th>

                                <th class="py-2  text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900">
                            @foreach ($clients->chunk(50) as $array)
                                @foreach ($array as $client)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-2 text-center">{{ $client->rnc }}</td>
                                        <td class="px-4 py-2 2xl:max-w-72 ">{{ $client->name }}</td>
                                        <td class="px-4 py-2 text-center">{{ str_replace('-','',$client->phone) }}</td>
                                        <td class="px-4 py-2 text-center">${{ $client->debt }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ $client->invoices->count()>0?route('invoices_filter', $client->id):'javascript:void(0);' }}">{{ $client->invoices->count() }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-center">{{ $client->accounts->count() }}</td>
                                        <td class="px-2  text-center">

                                            <x-modal modalId="edit{{ $client->id }}">
                                                <x-slot name="title">
                                                    <span class="fas fa-pen mx-2"></span>
                                                </x-slot>
                                                @livewire('edit-client', ['client' => $client], key($client->id))
                                            </x-modal>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <span class="fas {{ $icon }} text-red-400 cursor-pointer"
                                                onclick="confirm('{{ $confirm }}')|| event.stopImmediatePropagation()"
                                                wire:click="softdelete('{{ $client->slug }}')">
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $clients->links() !!}
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

        .table {
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

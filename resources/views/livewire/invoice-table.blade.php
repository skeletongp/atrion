<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        {{-- Btn Papelera --}}
        @role('Admin')
        <span class="fa {{ $button }} cursor-pointer text-2xl" wire:click='toggle'></span>
        @endrole
       
        
        <div class="  lg:w-2/3 mx-auto my-4 flex items-center justify-center ">
            <div class="flex border border-1 border-blue-200 rounded-md items-center w-11/12">
                <span
                    class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-1/6">Búsqueda:</span>
                <input name="search"
                    class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 lg:w-5/6 overflow-auto"
                    id="search" type="search" invoiceholder="Buscar producto" value="{{ old('search') }}"
                    wire:model.defer="search" />
            </div>
            <div>
                <span class="fas fa-search ml-2 text-xl cursor-pointer" wire:click="search" id="sp-search"></span>
            </div>
        </div>

        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
           @if ($client_id>0)
           <h1 class="font-bold text-center">Facturas de: <span class="text-lg uppercase">{{$invoices->first()->client->name}}</span></h1>
           @endif
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 34rem">
                    <table class="table-auto  lg:w-2/3 mx-auto table">
                        <thead>
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2 " wire:clicK="order('name')">Cliente
                                    </span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('date')">Fecha
                                    <span class="fas {{ $order == 'date' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('total')">Total
                                    <span class="fas {{ $order == 'total' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center ">Vendedor</th>

                                <th class="px-4 py-2  text-center ">Deuda

                                </th>

                                <th class="py-2  text-center" colspan="1">Detalles</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900">
                            @foreach ($invoices->chunk(50) as $array)
                                @foreach ($array as $invoice)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-2 lg:w-56 lg:max-w-56 cursor-pointer">
                                            @role('Admin')
                                            <span class="fas {{ $icon }} text-red-400 cursor-pointer"
                                                onclick="confirm('{{ $confirm }}')|| event.stopImmediatePropagation()"
                                                wire:click="softdelete('{{ $invoice->number }}')">
                                            </span>
                                            @endrole
                                            <a href="{{route('invoices_filter',$invoice->client->id)}}">{{ $invoice->client->name }}</a>
                                        </td>
                                        <td class="px-4 py-2 text-center">{{ $invoice->date }}</td>
                                        <td class="px-4 py-2 text-center">${{ $invoice->total }}</td>
                                        <td class="px-4 py-2 text-center">{{ $invoice->user->name }}</td>
                                        <td class="px-4 py-2 text-center">
                                            {{ $invoice->rest > 0 ? '$'.$invoice->rest : 'Saldada' }}</td>
                                        <td class="px-2  text-center">
                                            <a href="{{ route('preview', $invoice) }}">
                                                <span class="fas fa-eye mx-2"></span>
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $invoices->links() !!}
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

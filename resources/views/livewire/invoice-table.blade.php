<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        {{-- Btn Papelera --}}
        @role('Admin')
        <span class="fa {{ $button }} cursor-pointer text-2xl" wire:click='toggle'></span>
        @endrole

        <h1 class="uppercase font-bold text-2xl text-center">
           
            {{$is_active==0?'Papelera':'Historial'}} de {{$type=="invoice"?'Facturas':'Cotizaciones'}}
          
        </h1>
        <div class="  lg:w-2/3 mx-auto my-4 flex items-center justify-center ">
            {{-- Buscar --}}
            <div class="flex border border-1 border-blue-200 rounded-md items-center w-9/12">
                <span
                    class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-1/6">Búsqueda:</span>
                <input name="search"
                    class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 lg:w-5/6 overflow-auto"
                    id="search" type="search" placeholder="Buscar producto" value="{{ old('search') }}"
                    wire:model.defer="search" />
            </div>

            {{-- Filtrar --}}
            <div class="hidden lg:inline">
                <div class="flex border border-1 border-blue-200 rounded-md items-center ml-2 ">
                    <span
                        class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-3/6">Ver:</span>
                    <select name="" id="" wire:model="amount"
                        class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 overflow-auto ">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

            </div>
            {{$order}}
        </div>

        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
            @if ($client_id > 0 && $invoices->first())
                <h1 class="font-bold text-center">Facturas de: <span
                        class="text-lg uppercase">{{ $invoices->first()->client->name }}</span></h1>
            @endif
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 34rem">
                    <table class="table-auto  lg:w-2/3 mx-auto table">
                        <thead>
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2 cursor-pointer" wire:clicK="order('clients.name')">Cliente
                                    <span class="fas {{ $order == 'clients.name' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('date')">Fecha
                                    <span class="fas {{ $order == 'date' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('total')">Total
                                    <span class="fas {{ $order == 'total' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('users.name')">
                                    Vendedor
                                    <span class="fas {{ $order == 'users.name' ? $icon_order : 'fa-sort' }}"></span>
                                </th>

                                @if ($type == 'invoice')
                                    <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('rest')">Deuda
                                        <span class="fas {{ $order == 'rest' ? $icon_order : 'fa-sort' }}"></span>
                                    </th>
                                @else

                                @endif

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
                                                wire:click="softdelete('{{ $invoice->id }}')">
                                            </span>
                                            @endrole
                                            <a
                                                href="{{ route('invoices_filter', $invoice->client->id) }}">{{ $invoice->client->name }}</a>
                                        </td>
                                        <td class="px-4 py-2 text-center">{{ $invoice->date }}</td>
                                        <td class="px-4 py-2 text-center">${{ $invoice->total }}</td>
                                        <td class="px-4 py-2 text-center">{{ $invoice->salor->name }}</td>
                                        @if ($invoice->cash)
                                            <td class="px-4 py-2 text-center">
                                                {{ $invoice->rest > 0 ? '$' . $invoice->rest : 'Saldada' }}</td>
                                        @endif
                                        <td class="px-2  text-center">
                                            <a href="{{ route('preview', $invoice) }}">
                                                <span class="fas fa-eye mx-2"></span>
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach
                            <tr class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base text-white"
                                style="background-color: black">
                                <td class="px-4 py-2 lg:w-56 lg:max-w-56 text-center font-bold" colspan="2">
                                    TOTALES
                                </td>
                                <td class="px-4 py-2 text-center font-bold">${{ $invoices->sum('total') }}</td>
                                <td class="px-4 py-2 text-center font-bold"></td>
                                @if ($type=="invoice")
                                <td class="px-4 py-2 text-center font-bold">
                                    ${{ $invoices->sum('rest') }}</td>
                                @else
                                <td class="px-4 py-2 text-center font-bold"></td>
                                @endif
                                @if ($type=="invoice")
                                    <td class="px-2  text-center">

                                    </td>
                                @endif

                            </tr>

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

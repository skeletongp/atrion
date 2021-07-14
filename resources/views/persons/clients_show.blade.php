<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del perfil') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <h2 class="text-center uppercase font-bold text-xl">{{ $client->name }}</h2>
            <div class="lg:flex justify-between">
                {{-- Tabla de las cuentas del cliente --}}
                <div>
                    <h3 class="lg:text-center font-bold uppercase my-2">Cuentas del cliente</h3>
                    <div>
                        <table class="table-auto w-full mx-auto ">
                            <thead>
                                <tr class="rounded-lg text-sm font-medium text-gray-900 text-left uppercase"
                                    style="font-size: 0.9674rem">
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer relative select-none ">
                                        No.
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer relative select-none ">
                                        Fecha
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white select-none text-center">
                                        Ult. Pago
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer select-none relative text-center">
                                        Monto

                                    </th>

                                    <th class="py-2 px-2 bg-blue-100 text-center" colspan="2">Saldo</th>
                                </tr>
                            </thead>
                            <tbody class="text-md font-normal text-white rounded-xl border-none">
                                @if ($client->accounts->count()>0)
                                    @foreach ($client->accounts as $account)
                                        <tr class=" border-b border-gray-200 hover:text-blue-200"
                                            style="background-color: #293949">
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ $account->id }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ substr($account->created_at, 0, 10) }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ substr($account->updated_at, 0, 10) }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                ${{ $account->amount }}
                                            </td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                ${{ $account->balance }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">
                                            <h2 class="font-bold text-lg text-center text-gray-900">Este cliente no tiene cuentas activas</h2>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="lg:hidden my-4 shadow-xl" />
                {{-- Tabla de facturas del cliente --}}
                <div>
                    <h3 class="lg:text-center font-bold uppercase my-2">Facturas del cliente 
                        <span class="fas fa-eye-slash cursor-pointer" id="sp-client-invoices"></span>
                    </h3>
                    <div id="div-client-invoices">
                        <table class="table-auto w-full mx-auto ">
                            <thead>
                                <tr class="rounded-lg text-sm font-medium text-gray-900 text-left uppercase"
                                    style="font-size: 0.9674rem">
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer relative select-none ">
                                        No.
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer relative select-none ">
                                        Fecha
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white select-none text-center">
                                        Total
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer select-none relative text-center">
                                        Vendedor

                                    </th>

                                    <th class="py-2 px-2 bg-blue-100 text-center" >Sucursal</th>
                                    <th class="py-2 px-2 bg-blue-100 text-center" >Abrir</th>
                                </tr>
                            </thead>
                            <tbody class="text-md font-normal text-white rounded-xl border-none">
                                @if ($client->invoices->count()>0)
                                    @foreach ($client->invoices as $invoice)
                                        <tr class=" border-b border-gray-200 hover:text-blue-200"
                                            style="background-color: #293949">
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ $invoice->id }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ substr($invoice->created_at, 0, 10) }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                ${{ $invoice->total, 0, 10 }}</td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ $invoice->user->name }}
                                            </td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                                {{ $invoice->place->name }}
                                            </td>
                                            <td class="px-4 py-1 border border-l border-white text-center">
                                               <span class="far fa-file-pdf cursor-pointer"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6">
                                            <h2 class="font-bold text-lg text-center text-gray-900">Este cliente no tiene facturas activas</h2>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

<div>
    <div class=" w-full h-full ml-12 flex-1 items-center justify-between mx-auto">
        <div class="mx-auto w-max mb-4">
            <h3 class="lg:text-center font-bold uppercase">Datos del cliente</h3>
            <a class="block relative  max-w-xs w-60 bg-gray-100 px-3 py-2 rounded-md no-underline z-0 overflow-hidden card-1 cursor-default"
                href="javascript:void(0);">
                <h3 class="head text-xl font-bold">{{ $client->name }}</h3>
                <p class="parraf font-semibold text-gray-900 text-md">
                    <span>{{ $client->phone }}</span> <br>
                    <span>${{ $client->debt }}</span>
                </p>
                <div class="flex items-center absolute justify-center w-8 h-8 top-0 right-0 text-white"
                    style=" border-radius: 0 4px 0 32px; background-color:#00838d;" href="#">
                    <div class="-mt-1 -mr-1 text-white font-bold">
                        →
                    </div>
                </div>
                <div class="absolute right-2 bottom-2 flex div-icon">
                    <span class="fas fa-dollar-sign cursor-pointer mx-2" id="sp-account" title="Ver cuentas">
                        {{ $client->accounts->count() }}</span>
                    <span class="fas fa-file-invoice cursor-pointer mx-2" title="Ver compras">
                        {{ $client->invoices->count() }}</span>
                </div>
            </a>
        </div>
        <div id="div-edit" class="hidden  w-2/3  mx-auto ">
            @livewire('edit-client', ['client' => $client], key($client->id))
        </div>
        <div class="  mt-2 lg:mt-0 overflow-x-auto select-none lg:w-2/3 mx-auto" id="div-account">
            {{-- Tabla de cuentas --}}
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
                            <th class="px-4 py-2 bg-blue-100 border border-l-1 border-white select-none text-center">
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
                        @foreach ($client->accounts as $account)
                            <tr class=" border-b border-gray-200 hover:text-blue-200" style="background-color: #293949">
                                <td class="px-4 py-1 border border-l border-white text-center">{{ $account->id }}</td>
                                <td class="px-4 py-1 border border-l border-white text-center">
                                    {{ substr($account->created_at, 0, 10) }}</td>
                                <td class="px-4 py-1 border border-l border-white text-center">
                                    {{ substr($account->updated_at, 0, 10) }}</td>
                                <td class="px-4 py-1 border border-l border-white text-center">${{ $account->amount }}
                                </td>
                                <td class="px-4 py-1 border border-l border-white text-center">${{ $account->balance }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        
    </style>
    
</div>

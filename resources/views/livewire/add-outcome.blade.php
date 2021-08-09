<div>
    <div>
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4 text-center">Registro de Egreso</h1>
        <form action="javascript:void(0);">
            <div class="">
                <div class="mx-1 my-2">
                    <x-input_select name="concept" label="Tipo" placeholder="Tipo de egreso" model="concept">
                        <option value="Compra">Compra</option>
                        <option value="Devolución">Devolución</option>
                        <option value="Pago Servicio">Pago Servicio</option>
                        <option value="Pago Empleado">Pago Empleado</option>
                    </x-input_select>
                    <x-jet-input-error for="concept"></x-jet-input-error>
                </div>

                <div class="mx-1 my-2">
                    <x-input_text name="amount" label="Monto" :oldValue="''" placeholder="Monto" type="number"
                        model="amount"></x-input_text>
                    <x-jet-input-error for="amount"></x-jet-input-error>
                </div>

                @if ($concept != 'Devolución')
                    <div class="mx-1 my-2">
                        <x-input_text name="reference" label="Referencia" :oldValue="''"
                            placeholder="Ref. del documento" type="text" model="reference"></x-input_text>
                        <x-jet-input-error for="reference"></x-jet-input-error>
                    </div>
                @endif
                @if ($concept == 'Devolución')
                    <div class=" mx-1 my-2">
                        <x-input_select name="client_id" label="Cliente" placeholder="Cliente" model="client_id">
                            @foreach ($clients->chunk(50) as $array)
                                @foreach ($array as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            @endforeach
                        </x-input_select>
                        <x-jet-input-error for="reference"></x-jet-input-error>
                    </div>
                    @if ($client_id > 0)
                        <div class="mx-1 my-2">
                            <x-input_select name="reference" label="Factura" placeholder="Factura" model="reference">
                                @foreach ($invoices->chunk(50) as $array)
                                    @foreach ($array as $invoice)
                                        <option value="{{ $invoice->id }}">{{ $invoice->number }}</option>
                                    @endforeach
                                @endforeach
                            </x-input_select>
                            <x-jet-input-error for="reference"></x-jet-input-error>
                        </div>
                    @endif
                @else
                    <div class=" mx-1 my-2 flex">
                        <div class="w-full">
                            <x-input_select name="provider_id" label="Proveedor" placeholder="Proveedor"
                                model="provider_id">
                                @foreach ($providers->chunk(50) as $array)
                                    @foreach ($array as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                @endforeach
                            </x-input_select>
                            <x-jet-input-error for="provider_id"></x-jet-input-error>
                        </div>
                        <x-modal modalId="modalAddProvider">
                            <x-slot name='title'><span class="fas fa-plus"></span></x-slot>
                            @livewire('add-provider', key('prov'))
                        </x-modal>
                    </div>
                @endif
                <div class=" mx-1 my-2 flex justify-end">
                    <x-jet-button wire:click="store">Registrar</x-jet-button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('select[name="concept"]').change(function() {
                    @this.set('concept', $(this).val());
                })
            Livewire.hook('element.updated', function() {
                
                $('select[name="client_id"]').change(function() {
                    @this.set('client_id', $(this).val());
                })
                
            })
        })
    </script>
</div>

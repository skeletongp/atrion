<div>
            <div>
                <h1 class="uppercase font-bold text-md lg:text-xl mb-4 text-center">Editar Cliente</h1>
               
                    <div class="  mx-auto">
                        <div class=" mx-1 my-2">
                            <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre"
                                type="text" model="name"></x-input_text>
                            <x-jet-input-error for="name"></x-jet-input-error>
                        </div>
                        <div class=" mx-1 my-2">
                            <x-input_text name="phone" label="Teléfono" :oldValue="''" placeholder="000-000-0000"
                                type="tel" model="phone"></x-input_text>
                            <x-jet-input-error for="phone"></x-jet-input-error>
                        </div>

                    </div>
                    <div class="w-full">
                        <div class="mx-1 my-2">
                            <x-input_text name="rnc" label="RNC/ID" :oldValue="''" placeholder="RNC/Cédula" type="rnc"
                                model="rnc"></x-input_text>
                            <x-jet-input-error for="rnc"></x-jet-input-error>
                        </div>
                    </div>
                    <div class="flex justify-end m-2">
                        <x-jet-button wire:click="update('{{$client->slug}}')">Actualizar</x-jet-button>
                    </div>

            </div>

</div>

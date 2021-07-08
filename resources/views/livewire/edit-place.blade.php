<div class="relative">
    <div>
        <span class="fas fa-pen text-blue-400 cursor-pointer mx-1 sp-edit" wire:click="$set('open',true)"
            ></span>
    </div>
 <div class="fixed bottom-2">
    <x-jet-dialog-modal wire:model="open">
        @slot('title')

        @endslot
        @slot('content')
            <div class="relative mt-4">
                <h1 class="uppercase font-bold text-xl lg:text-2xl mb-2">Editar</h1>
                <span class="fas fa-times text-red-700 font-bold text-xl absolute right-2 top-2 cursor-pointer" wire:click="$set('open', false)"></span>
                <div class="space-y-1">
                    <div class="mx-1 ">
                        <x-input_text name="name" label="Nombre" :oldValue="$place->name" placeholder="Ingrese el nombre" type="text"
                            model="name"></x-input_text>
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div class="mx-1 ">
                        <x-input_text name="phone" label="Teléfono" :oldValue="''" placeholder="Ingrese el teléfono"
                            type="tel" model="phone"></x-input_text>
                        <x-jet-input-error for="phone"></x-jet-input-error>
                    </div>

                    <div class=" mx-1 ">
                        <x-input_text name="location" label="Ubicación" :oldValue="''" placeholder="Ingrese la ubicación"
                            type="text" model="location"></x-input_text>
                        <x-jet-input-error for="location"></x-jet-input-error>
                    </div>
                </div>

             

            </div>
        @endslot
        @slot('footer')
        <div class="flex justify-end mx-2">
            <x-jet-button wire:click="store ('{{$place->slug}}')">Actualizar</x-jet-button>
        </div>  
        @endslot
    </x-jet-dialog-modal>
 </div>
</div>

<div>
    <span class="fas fa-plus cursor-pointer" wire:click="$set('open',true)"></span>
    <div>
        <x-jet-dialog-modal wire:model="open">
            @slot('title')
                
            @endslot
            @slot('content')
                <div class="lg:flex">
                    <div class="lg:w-1/2 mx-1 my-2">
                        <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre" type="text"
                        model="name"></x-input_text>
                    <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div class="lg:w-1/2 mx-1 my-2">
                        <x-input_text name="meta" label="Descripción" :oldValue="''" placeholder="Breve descripción"
                        type="tel" model="meta"></x-input_text>
                    <x-jet-input-error for="meta"></x-jet-input-error>
                    </div>
                </div>
            @endslot
            @slot('footer')
                <x-jet-button wire:click="store">Guardar</x-jet-button>
            @endslot
        </x-jet-dialog-modal>
    </div>
</div>

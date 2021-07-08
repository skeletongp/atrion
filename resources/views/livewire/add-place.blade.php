<div>

    <div>
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4">Nueva Sucursal</h1>
        <div class="lg:flex">
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre"
                    type="text" model="name"></x-input_text>
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="phone" label="Teléfono" :oldValue="''" placeholder="Ingrese el teléfono"
                    type="tel" model="phone"></x-input_text>
                <x-jet-input-error for="phone"></x-jet-input-error>
            </div>
        </div>
        
        <div class="lg:flex ">
            <div class=" mx-1 my-2 w-full">
                <x-input_text name="location" label="Ubicación" :oldValue="''" placeholder="Ingrese la ubicación"
                    type="text" model="location"></x-input_text>
                <x-jet-input-error for="location"></x-jet-input-error>
            </div>
        </div>
        
        <div class="flex justify-end m-2">
            <x-jet-button wire:click="store">Guardar</x-jet-button>
        </div>

    </div>
</div>

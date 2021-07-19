<div class="w-full">
    
 <div class="">
    <div class=" mt-4">
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-2">Editar</h1>
        
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
        <div class="flex justify-end mx-2 my-2">
            <x-jet-button wire:click="update ('{{$place->slug}}')">Actualizar</x-jet-button>
        </div>  
     </div>
</div>

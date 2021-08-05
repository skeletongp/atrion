<div>

    <div>
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4">Nuevo Suplidor</h1>
        <form action="javascript:void(0);">
            <div class="lg:flex">
                <div class="lg:w-1/2 mx-1 my-2">
                    <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre" type="text"
                        model="name"></x-input_text>
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>
                <div class="lg:w-1/2 mx-1 my-2">
                    <x-input_text name="phone" label="Teléfono" :oldValue="''" placeholder="Ingrese el teléfono" type="tel"
                        model="phone"></x-input_text>
                    <x-jet-input-error for="phone"></x-jet-input-error>
                </div>
            </div>
    
            <div class="lg:flex ">
                <div class="lg:w-8/12 mx-1 my-2">
                    <x-input_text name="meta" label="Descripción" :oldValue="''" placeholder="Ingrese una breve descripción" type="text"
                        model="meta"></x-input_text>
                    <x-jet-input-error for="meta"></x-jet-input-error>
                </div>
                <div class="lg:w-4/12 mx-1 my-2">
                    <x-input_text name="debt" label="Deuda" :oldValue="''" placeholder="Deuda" type="number"
                        model="debt"></x-input_text>
                    <x-jet-input-error for="debt"></x-jet-input-error>
                </div>
               
            </div>
            <div class="w-full">
                <x-multiselect name="days" label="Permisos" table="days"  :placeholder="'Días de visita'"
                    input_id="permissions"></x-multiselect>
            </div>
    
            <div class="flex justify-end m-2">
                <x-jet-button wire:click="store">Guardar</x-jet-button>
              
            </div>
        </form>
       

    </div>
</div>

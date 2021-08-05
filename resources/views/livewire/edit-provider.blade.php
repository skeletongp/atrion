<div>
    <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4">Editar Suplidor</h1>
    <form action="javascript:void(0);">
        <div class="lg:flex">
            <div class="lg:w-3/5 mx-1 my-2">
                <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre" type="text"
                    model="name"></x-input_text>
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="lg:w-2/5 mx-1 my-2">
                <x-input_text name="phone" label="Teléfono" :oldValue="''" placeholder="Ingrese el teléfono" type="tel"
                    model="phone"></x-input_text>
                <x-jet-input-error for="phone"></x-jet-input-error>
            </div>
        </div>

        <div class="lg:flex ">
            <div class="lg:w-full mx-1 my-2">
                <x-input_text name="meta" label="Descripción" :oldValue="''" placeholder="Ingrese una breve descripción"
                    type="text" model="meta"></x-input_text>
                <x-jet-input-error for="meta"></x-jet-input-error>
            </div>


        </div>
        <x-jet-label for="days" class="text-md text-left mx-1 font-bold mb-2 mt-3">Días de visita</x-jet-label>
        <div class="w-full lg:flex lg:mx-1 items-center space-y-2 lg:space-y-0  space-x-2 ">
            <div class="flex items-center  space-x-2 ">
                @foreach ($days as $hasDay)
                    <div class="px-2 py-1 rounded-xl" style="background-color: #88f0b3 !important">
                        <span class="flex space-x-2 items-center cursor-pointer" wire:click="removeDay('{{ $hasDay }}')">{{ $hasDay }} </span>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center  space-x-2 ">
                @foreach ($notDays as $notDay)
                    <div class="px-2 py-1 rounded-xl" style="background-color: #ee9999 !important">
                        <span class="flex space-x-2 items-center cursor-pointer" wire:click="select('{{ $notDay }}')">{{ $notDay }} </span>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="flex justify-end m-2">
            <x-jet-button wire:click="update">Guardar</x-jet-button>

        </div>
    </form>
</div>

<div>

    <div>
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4">Nuevo Usuario</h1>
        <div class="lg:flex">
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre"
                    type="text" model="name"></x-input_text>
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="email" label="Correo" :oldValue="''" placeholder="Ingrese el correo"
                    type="email" model="email"></x-input_text>
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>
        </div>
        
        <div class="lg:flex ">
            
            <div class="lg:w-1/3 mx-1 my-2">
                <x-input_select name="role" label="Rol" placeholder="Asigne un rol" model="role">
                    @foreach ($roles as $rol)
                    <option value="{{$rol->name}}" {{$role=$rol->name ?'selected':''}}>{{$rol->name}}</option>
                @endforeach
                </x-input_select>
                <x-jet-input-error for="role"></x-jet-input-error>
            </div>
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_select name="place_id" label="Sede" placeholder="Asigne una sucursal" model="place_id">
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}" >
                            {{ $place->name }}</option>
                    @endforeach
                </x-input_select>
                <x-jet-input-error for="place_id"></x-jet-input-error>
            </div>
        </div>
        
        <div class="flex justify-end m-2">
            <x-jet-button wire:click="store">Guardar</x-jet-button>
        </div>

    </div>
</div>

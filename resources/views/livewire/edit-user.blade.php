<div>

    <div>

        <div class="lg:flex">
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="name" label="Nombre" :oldValue="$user->name" placeholder="Ingrese el nombre"
                    type="text" model="name"></x-input_text>
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="lg:w-1/2 mx-1 my-2">
                <x-input_text name="email" label="Correo" :oldValue="$user->email" placeholder="Ingrese el correo"
                    type="email" model="email"></x-input_text>
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>
        </div>
        @if ($user->id == Auth::user()->id)
            <div class="lg:flex ">
                <div class="lg:w-1/2 mx-1 my-2">
                    <x-input_text name="password" label="Contraseña" :oldValue="''"
                        placeholder="Ingrese nueva contraseña" type="password" model="password"> </x-input_text>
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>
                <div class="lg:w-1/2 mx-1 my-2">
                    <x-input_text name="password_confirm" label="Contraseña" :oldValue="''"
                        placeholder="Repita nueva contraseña" type="password" model="password_confirm"></x-input_text>
                    <x-jet-input-error for="password_confirm"></x-jet-input-error>
                </div>
            </div>
        @else
        <div class="lg:flex ">
            
            <div class="lg:w-1/4 mx-1 my-2">
                <x-jet-label for="role">Rol:</x-jet-label>
                <select
                wire:model.defer="role" 
                class="border-l-0  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                name="role_id" id="role_id">
                    @foreach ($roles as $rol)
                        <option value="{{$rol->name}}" {{$role=$rol->name ?'selected':''}}>{{$rol->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        @endif
        <div class="flex justify-end m-2">
            <x-jet-button wire:click="update">Guardar</x-jet-button>
        </div>

    </div>
</div>

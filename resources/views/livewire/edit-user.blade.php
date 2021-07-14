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
             <div class="lg:flex  mx-auto">
                 <div class="lg:w-1/2 mx-1 my-2">
                     <x-input_select name="role" label="Rol" placeholder="Asigne un rol" model="role"  >
                         @foreach ($roles as $rol)
                         <option value="{{ $rol->name }}" class="{{ $role==$rol->name ?'text-green-500' : '' }}">
                             {{ $rol->name }}</option>
                     @endforeach
                     </x-input_select>                    
                     <x-jet-input-error for="role"></x-jet-input-error>
                 </div>
                 <div class="lg:w-1/2 mx-1 my-2">
                     <x-input_select name="place_id" label="Sede" placeholder="Asigne una sucursal" model="place_id">
                         @foreach ($places as $place)
                             <option value="{{ $place->id }}" class="{{ $user->place_id == $place->id ? 'text-green-500' : '' }}">
                                 {{ $place->name }}</option>
                         @endforeach
                     </x-input_select>
                     <x-jet-input-error for="place_id"></x-jet-input-error>
                 </div>
                 
             </div>
             
         @endif
         <div class="flex justify-end m-2">
             <x-jet-button wire:click="update">Guardar</x-jet-button>
         </div>
 
     </div>
 </div>
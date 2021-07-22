<div>
    @if (session('success'))
        <div class="flex justify-end" id="div-success">
            <div class="flex justify-end espace-x-4 cursor-pointer" id="sp-success">
                <span class="mx-2 text-green-600 ">{{ session('success') }}</span>
                <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center">
                    <span class="fas fa-times"></span>
                </div>
            </div>
        </div>
    @endif
    @if (session('added'))
        <div class="flex justify-end" id="div-success">
            <div class="flex justify-end espace-x-4 cursor-pointer" id="sp-success">
                <span class="mx-2 text-green-600 ">{{ session('added') }}</span>
                <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center">
                    <span class="fas fa-times"></span>
                </div>
            </div>
        </div>
    @endif
    <div class="lg:grid grid-cols-4 grid-rows-2  bg-white gap-2 p-4 rounded-xl">
        <div class="lg:col-span-1 h-48 shadow-xl ">
            <div class="flex w-full h-full relative">
                <img src="{{ $user->profile_photo_url }}" class="w-44 h-44 m-auto rounded-full" alt="">

            </div>
        </div>
        <div class="lg:col-span-3 h-56 lg:h-48 shadow-xl p-4 space-y-2">
            <x-input_text name='' label='Nombre' :oldValue="$user->name" type="text" placeholder="''" readonly
                model="name" />
            <x-input_text name='' label='Correo' :oldValue="$user->email" type="text" placeholder="''" readonly
                model="email" />
            <div class="lg:flex lg:space-x-4 space-y-2 lg:space-y-0">
                <x-input_text name='' label='Rol ' :oldValue="$user->getRoleNames()[0]" type="text" placeholder="''"
                    readonly model="role" />
                <x-input_text name='' label='Sede ' :oldValue="$user->place->name" type="text" placeholder="''" readonly
                    model="place" />
                    <x-input_text name='' label='Ventas' :oldValue="$user->sales->count()" type="text" placeholder="''" readonly
                        model="sales" />
            </div>
        </div>
        <div class="lg:col-span-4  shadow-xl bg-white p-4 hidden lg:block">
            <h1 class="m-4 text-3xl font-bold text-center">Permisos</h1>
            <div class="lg:grid grid-cols-3 h-max">
                @foreach ($permissions as $permission)
                    <span class="p-2 bg-gray-100 m-1 h-6 flex items-center justify-between rounded-xl ">
                        <span>
                            <span
                                class="{{ $user->can($permission->name) ? 'fas fa-check text-green-500' : 'fas fa-times text-red-500' }} mr-2">
                            </span>{{ $permission->name }} </span>
                        @can('Gestionar Usuarios', User::class)
                            @if ($user->id != Auth::user()->id)
                                @if ($user->can($permission->name))
                                    <span class="fas fa-minus text-red-500 mx-1 cursor-pointer"
                                        onclick="confirm('¿Revocar permiso al usuario?') || event.stopImmediatePropagation()"
                                        wire:click="revoke('{{ $permission->name }}')" title="Revocar">
                                    @else
                                        <span class="fas fa-plus text-green-500 mx-1 cursor-pointer" title="Asignar"
                                            onclick="confirm('Asignar permiso al usuario?') || event.stopImmediatePropagation()"
                                            wire:click="assign('{{ $permission->name }}')">
                                @endif

                            @endif
                        </span>
                    @endcan
                    </span>
                @endforeach
            </div>
        </div>
        <script>

        </script>
    </div>
</div>

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
            </div>
        </div>
        <div class="lg:col-span-4  shadow-xl bg-white p-4 hidden lg:block">
            <h1 class="m-4 text-3xl font-bold text-center">Permisos</h1>
            <div class="lg:grid grid-cols-4 h-max">
                @foreach ($user->getAllPermissions() as $permission)
                    <span
                        class="p-2 bg-gray-100 m-1 h-8 flex items-center justify-center rounded-xl">{{ $permission->name }}</span>
                @endforeach
            </div>
        </div>
        <script>
          
        </script>
    </div>
</div>

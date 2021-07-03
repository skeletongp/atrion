<div>
    @if (session('success'))
        <div class="flex justify-end" id="div-success">
            <div class="flex justify-end espace-x-4 cursor-pointer" id="sp-success">
                <span class="mx-2 text-green-600 ">{{ session('success') }}</span>
                <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center">
                    <span class="fas fa-times" ></span>
                </div>
            </div>
        </div>
    @endif
    <div class="lg:grid grid-cols-4 grid-rows-2  bg-white gap-2 p-4 rounded-xl">
        <div class="lg:col-span-1 h-48 shadow-xl ">
            <div class="flex w-full h-full relative">
                <img src="{{ $user->profile_photo_url }}" class="w-44 h-44 m-auto" alt="">

            </div>
        </div>
        <div class="lg:col-span-3 h-48 shadow-xl p-4 space-y-2">
            <x-input_text name='' label='Nombre' :oldValue="$user->name" type="text" placeholder="''" readonly
                model="name" />
            <x-input_text name='' label='Correo' :oldValue="$user->email" type="text" placeholder="''" readonly
                model="email" />
            <x-input_text name='' label='Rol ' :oldValue="$user->getRoleNames()[0]" type="text" placeholder="''"
                readonly model="role" />
        </div>
        <div class="lg:col-span-4 h-48 shadow-xl p-4 space-y-2 hidden lg:block">

        </div>
        <script>
            window.addEventListener('load', function() {
                $('#sp-success').click(function() {
                    $('#div-success').toggle('display', false);
                })
            })
        </script>
    </div>
</div>

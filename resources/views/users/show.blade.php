<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="lg:w-2/3 mx-auto">
                <div
                    class="absolute w-8 h-8 z-10 -m-l-8 rounded-full bg-gray-800 flex items-center justify-center text-green-600">
                    <a role="button" id="btn-edit"><span class="fas fa-pen cursor-pointer" id="sp-edit"></span></a>
                </div>
                <div id="div-profile">
                    @livewire('profile-card', ['user' => $user], key($user->id))
                </div>

                <div id="div-edit" class="hidden pl-1 bg-white shadow-lg pb-8 pt-3">
                    @livewire('edit-user', ['user' => $user], key($user->id))
                </div>
            </div>
        </div>
        <script>
            window.addEventListener('load', function() {
                $('#btn-edit').click(function() {
                    $('#div-edit').toggle('', false)
                    $('#div-profile').toggle('', false)
                    $('#sp-edit').toggleClass('fa-pen fa-times');
                })
            })
        </script>
    </div>
</x-app-layout>

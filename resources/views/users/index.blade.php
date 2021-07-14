<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="px-4 lg:w-1/3 ml-auto">
        <form action="{{ route('users.index') }}">
            <x-input_text name="search" placeholder="Buscar usuario" label="Búsqueda" type="search"
                oldValue="{{ $query }}" model="name"></x-input_text>
        </form>
    </div>
    <div class="p-4 relative">
        <div class="w-max mx-auto lg:ml-auto  mt-2 py-3 px-3 lg:mr-8 space-x-3 block">
            <span class="font-bold hidden md:inline">Ordenar por: </span>
            @sortablelink('name', 'Nombre')
            <span class="fas fa-ellipsis-v"></span>
            @sortablelink('email', 'Correo')
            <span class="fas fa-ellipsis-v"></span>
            @sortablelink('created_at', 'F. Creación')
        </div>
        <div class="cursor-pointer mx-1 w-8 h-8 rounded-full flex items-center justify-center bg-gray-900 absolute left-2 top-2 text-white hover:text-blue-300"
            title="Añadir usuario" id="btn-adduser">
            <span class="fas fa-plus  " id="sp-plus"></span>
        </div>
        <hr>
        <div id="div-user">

            <x-index_body :object="$users" id="">
                @foreach ($users as $user)
                    <livewire:data-card :title="$user->name" :title2="$user->email" :subtitle="$user->place->name"
                        :data1="$user->getRoleNames()[0]" :data2="$user->id" icon="fas fa-at" icon1="fas fa-user"
                        icon2="fas fa-store" icon3="fas fa-user-tie" icon4="fas fa-file-invoice" route="users_show"
                        edit="users_show" destroy="clients_destroy" :object="$user" :param="$user">
                @endforeach
            </x-index_body>
        </div>
    </div>

    <div class="lg:w-1/2 mx-auto hidden" id="div-form">
        @livewire('add-user')
    </div>
</x-app-layout>

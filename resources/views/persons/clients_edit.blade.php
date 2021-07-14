<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del perfil') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="lg:w-1/3 mx-auto">
                <div>
                    <h1 class="uppercase font-bold text-md lg:text-xl mb-4 text-center">Editar Cliente</h1>
                    <form action="{{ route('clients_update', $client) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="  mx-auto">
                            <div class=" mx-1 my-2">
                                <x-input_text name="name" label="Nombre" :oldValue="$client->name" placeholder="Ingrese el nombre"
                                    type="text" model=""></x-input_text>
                                <x-jet-input-error for="name"></x-jet-input-error>
                            </div>
                            <div class=" mx-1 my-2">
                                <x-input_text name="phone" label="Teléfono" :oldValue="$client->phone" placeholder="000-000-0000"
                                    type="tel" model=""></x-input_text>
                                <x-jet-input-error for="phone"></x-jet-input-error>
                            </div>

                        </div>

                        <div class="flex justify-end m-2">
                            <x-jet-button wire:click="store">Guardar</x-jet-button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>

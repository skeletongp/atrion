<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información del negocio') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="lg:w-2/3 mx-auto">
               
                @livewire('edit-company', key(2))

            </div>
        </div>
        
    </div>
</x-app-layout>

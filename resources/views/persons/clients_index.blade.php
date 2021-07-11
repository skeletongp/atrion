<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    
                <!-- component -->
                @livewire('table-clients', ['is_active'=>1])            
</x-app-layout>

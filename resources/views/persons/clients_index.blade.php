<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $estado == 1 ? __('Clientes') : __('Clientes: Papelera de reciclaje') }}
        </h2>
    </x-slot>
    
    @livewire('client-table')
</x-app-layout>

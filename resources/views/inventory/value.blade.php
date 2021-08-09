<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 ">
            {{ __('Valor de Inventario') }}
        </h2>
    </x-slot>
    
    <div class="pt-2 relative">            
            @livewire('value-table', key('1'))
    </div>
    
</x-app-layout>

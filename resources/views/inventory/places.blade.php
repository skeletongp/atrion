<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-900 leading-tight uppercase font-bold">
            {{ __('Sucursales') }}
        </h2>

    </x-slot>


   
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-1 justify-center mx-auto p-4" id="div-places" >
        @livewire('place-table')
    </div>
   
   
    
</x-app-layout>

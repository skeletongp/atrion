<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-900 leading-tight uppercase font-bold">
            {{ __('Sucursales') }}
        </h2>

    </x-slot>


    <div class="flex justify-end my-2 mr-4">
        <div class="w-8 h-8 rounded-full shadow-xl bg-gray-900 text-white flex items-center justify-center cursor-pointer"
            id="btn-add">
            <span class="fas fa-plus" id="sp-add-place"></span>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-1 justify-center mx-auto p-4" id="div-places" >
        @livewire('place-card')
    </div>
    <div class="lg:w-1/2 mx-2  lg:mx-auto hidden shadow-lg p-4 bg-white rounded-xl my-4" id="div-add">
        @livewire('add-place')
    </div>

   
    
</x-app-layout>

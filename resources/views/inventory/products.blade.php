<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
        
    </x-slot>

    <div class="py-12 relative">
        <div class="absolute w-8 h-8 bg-gray-900 text-white top-2 right-2 flex items-center justify-center rounded-full cursor-pointer" id="btn-add-product">
            <span class="fas fa-plus" id="sp-plus-product"></span>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1 justify-center">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-1 justify-center mx-auto relative py-8" id="div-table-product">
                @livewire('product-table')
            </div>
            <div class="hidden lg:w-2/4 mx-auto" id="div-add-product">
                @livewire('add-product')
            </div>
           
        </div>
       
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 ">
            {{ __('Inventario') }}
        </h2>
    </x-slot>
    
    <div class="pt-2 relative">            
            @livewire('product-table', key('1'))
            @if (isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
            @endif    
          
    </div>
    
</x-app-layout>

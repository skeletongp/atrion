<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 ">
            {{ $cotize?'Cotizar':'Facturar' }}
        </h2>
    </x-slot>
    
    <div class="pt-2 relative ">            
           @if ($cotize)
           @livewire('make-invoice',['cotize'=>1])
           @else
           @livewire('make-invoice',['cotize'=>0])
           @endif
            @if (isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
            @endif       
    </div>
</x-app-layout>

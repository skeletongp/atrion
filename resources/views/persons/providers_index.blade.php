<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suplidores') }}
        </h2>
    </x-slot>

    <div class="pt-2 relative">            
        @livewire('provider-table')
        @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
        @endif       
</div>
</x-app-layout>

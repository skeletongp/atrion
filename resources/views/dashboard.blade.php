<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-sm lg:text-xl text-gray-800 leading-tight mt-3">
            {{ __('Dashboard') }} <br>
           @if (Auth::user()->cash)
           <span class="text-xs">Desde las: {{substr(Auth::user()->cash->created_at,10)}}</span>
           @endif
        </h2>
        
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1 justify-center">
            <div class="bg-white shadow-xl sm:rounded-lg flex-1 justify-center mx-auto">
               
                
                @livewire('cash-view', ['user' => Auth::user()], key(Auth::user()->id))
            </div>
        </div>
    </div>
</x-app-layout>

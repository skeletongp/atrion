<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1 justify-center">
            <div class="bg-white shadow-xl sm:rounded-lg flex-1 justify-center mx-auto">
                <x-jet-welcome />
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>

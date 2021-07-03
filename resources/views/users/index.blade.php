<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- component -->
                @livewire('table-user', ['is_active'=>1])



                <script>
                    window.addEventListener('load', function() {
                        $('#sp-users').click(function() {

                        })
                    })
                </script>
                <style>
                    .show-options {
                        transform: translateY(10)
                    }

                </style>
            </div>
        </div>
    </div>
</x-app-layout>

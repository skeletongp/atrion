<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $estado==1?__('Clientes'):__('Clientes: Papelera de reciclaje') }}
        </h2>
    </x-slot>
    <div class="px-4 lg:w-1/3 ml-auto">
        <form action="{{ route('clients_index') }}" id="form-search">
            <x-input_text name="search" placeholder="Buscar cliente" label="Búsqueda" type="search" oldValue="{{$query}}"
                model="name"></x-input_text>
        </form>
    </div>
    <div class="p-4">
        <div class="w-max mx-auto lg:ml-auto  mt-2 py-3 px-3 lg:mr-8 space-x-3 block">
            <span class="font-bold hidden md:inline">Ordenar por: </span>
            @sortablelink('name', 'Nombre')
            <span class="fas fa-ellipsis-v"></span>
            @sortablelink('debt', 'Deuda')
            <span class="fas fa-ellipsis-v"></span>
            @sortablelink('created_at', 'F. Creación')
        </div>
        <hr>
        
           <x-index_body :object="$clients">
            @foreach ($clients as $client)
            <livewire:data-card :title="$client->name" 
                :title2="substr($client->created_at,0,10)"
                :subtitle="$client->phone" 
                :data1="$client->debt" 
                :data2="$client->invoices->count()"
                :icon="'fas fa-calendar-alt'" 
                icon1="fas fa-user" 
                icon2="fas fa-phone" 
                icon3="fas fa-dollar-sign text-red-500"
                icon4="fas fa-file-invoice text-blue-400" 
                route="clients_show" 
                edit="clients_edit" 
                destroy="clients_destroy"
                :object="$client"
                :param="$client">
             @endforeach
           </x-index_body>
    </div>
</x-app-layout>

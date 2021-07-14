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
        <div class="px-4 lg:w-1/3 ml-auto">
            <form action="{{ route('products_index') }}" id="form-search">
                <x-input_text name="search" placeholder="Buscar producto" label="Búsqueda" type="search" oldValue=""
                    model="name"></x-input_text>
            </form>
        </div>
        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center">
            <div class="w-max mx-auto lg:ml-auto  mt-2 py-3 px-3 lg:mr-8 space-x-3 block">
                <span class="font-bold hidden md:inline">Ordenar por: </span>
                @sortablelink('name', 'Nombre')
                <span class="fas fa-ellipsis-v"></span>
                @sortablelink('price', 'Precio')
                <span class="fas fa-ellipsis-v"></span>
                @sortablelink('stock', 'Existencia')
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-1 justify-center mx-auto relative py-8 px-2" id="div-table-product">
                <x-index_body :object="$products">
                    @foreach ($products as $product)
                    <livewire:data-card :title="$product->name" 
                        :title2="$product->cost.' / '.$product->price"
                        :subtitle="$product->meta" 
                        :data1="$product->category->name" 
                        :data2="$product->stock"
                        :icon="'fas fa-dollar-sign'" 
                        icon1="fas fa-boxes" 
                        icon2="fas fa-file-alt" 
                        icon3="fas fa-boxes text-green-600"
                        icon4="fas fa-store text-blue-600" 
                        route="clients_show" 
                        edit="clients_edit" 
                        destroy="clients_destroy"
                        :object="$product"
                        :param="$product">
                     @endforeach
                   </x-index_body>
            </div>
            <div class="hidden lg:w-2/4 mx-auto" id="div-add-product">
                @livewire('add-product')
            </div>
           
        </div>
       
    </div>
</x-app-layout>

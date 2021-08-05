<div>
    <div class="px-2">
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4 ">Nuevo Producto</h1>
        @if (!is_null($message))
            <div class="text-lg text-green-500 font-bold cursor-pointer select-none sp_product_added">
                <div wire:click="toggle">
                    <span class="fas fa-check"></span>
                    {{ $message }}
                </div>
            </div>
        @endif
        <div>
            <form action="javascript:void(0);">
                <div class="flex">
                    <div class="lg:w-1/3">
                        <x-input_text name="code" id="code" label="Código" :oldValue="''" placeholder="Ingrese el código"
                            type="text" model="code"></x-input_text>
                    </div>
                </div>
                <div class="lg:flex">
                    <div class="lg:w-3/5 mx-1 my-2">
                        <x-input_text name="name" label="Nombre" :oldValue="''" placeholder="Ingrese el nombre" type="text"
                            model="name"></x-input_text>
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div class="lg:w-2/5 mx-1 my-2 ">
                        <x-input_select name="category_id" model="category_id" placeholder="Elige una categoría"
                            label="Categoría">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            @slot('button')
                                @livewire('add-category')
                            @endslot
                        </x-input_select>
                        <x-jet-input-error for="category_id"></x-jet-input-error>
                    </div>
                </div>
                <div class="lg:flex">
                    <div class="lg:w-3/5 mx-1 my-2">
                        <x-input_text name="meta" label="Descripción" :oldValue="''"
                            placeholder="Ingrese una descripción corta" type="tel" model="meta"></x-input_text>
                        <x-jet-input-error for="meta"></x-jet-input-error>
                    </div>
                    <div class=" mx-1 my-2 lg:w-2/6">
                        @if ($is_product == 1)
                            <x-input_text name="stock" label="Stock" :oldValue="''" placeholder="Cant" type="number"
                                model="stock"></x-input_text>
                            <x-jet-input-error for="stock"></x-jet-input-error>
                        @endif
                    </div>
                    <div class=" mx-1 my-2 lg:w-2/6">
                        <div class="flex items-center border border-1 border-blue-200 rounded-md pr-1">
                            <span
                                class="text-sm rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-3/12">Tipo:</span>
                            <select
                                class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm w-9/12 overflow-auto "
                                name="is_product" id="is_product    " wire:model="is_product">
                                <option value="1">Producto</option>
                                <option value="0">Servicio</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="lg:flex ">
                    <div class="lg:w-3/5 mx-1 my-2 ">
                        <x-input_select name="place_id" model="place_id" placeholder="Elige una sucursal" label="Sucursal">
                            @foreach ($places as $place)
                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                            @endforeach
                        </x-input_select>
    
                        <x-jet-input-error for="place_id"></x-jet-input-error>
                    </div>
                    <div class="flex lg:w-4/5">
                        <div class=" mx-1 my-2 lg:w-1/2">
                            <x-input_text name="price" label="Precio" :oldValue="''" placeholder="Precio p/venta"
                                type="number" model="price"></x-input_text>
                            <x-jet-input-error for="price"></x-jet-input-error>
                        </div>
                        <div class=" mx-1 my-2 lg:w-1/2">
                            <x-input_text name="cost" label="Costo" :oldValue="''" placeholder="Costo p/compra"
                                type="number" model="cost"></x-input_text>
                            <x-jet-input-error for="cost"></x-jet-input-error>
                        </div>
                    </div>
    
                </div>
                <div class="flex justify-end m-2">
                    <x-jet-button wire:click="store">Guardar</x-jet-button>
                </div>
    
            </form>
        </div>

    </div>



</div>
<script>
    window.addEventListener('load', function() {
        $('#code').change(function() {
            alert("s")
        })
    })
</script>
</div>

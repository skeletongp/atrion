<div>
    <div class="px-2">
        <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4 ">Editar Producto</h1>
       
        <div>
            <div class="lg:flex">
                <div class="lg:w-3/5 mx-1 my-2">
                    <x-input_text name="name" label="Nombre" :oldValue="$product->name" placeholder="Ingrese el nombre" type="text"
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
                <div class="lg:w-2/3 mx-1 my-2">
                    <x-input_text name="meta" label="Descripción" :oldValue="''"
                        placeholder="Ingrese una descripción corta" type="tel" model="meta"></x-input_text>
                    <x-jet-input-error for="meta"></x-jet-input-error>
                </div>
                <div class=" mx-1 my-2 lg:w-1/3">
                    <x-input_text name="stock" label="Stock" :oldValue="''" placeholder="Existencia" type="number"
                        model="stock"></x-input_text>
                    <x-jet-input-error for="stock"></x-jet-input-error>
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
        </div>

    </div>

    <div class="flex justify-end m-2">
        <x-jet-button wire:click="update('{{$product->slug}}')">Guardar</x-jet-button>
    </div>

</div>

</div>

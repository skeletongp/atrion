<div class="space-y-3 ">
    <h1 class="uppercase font-bold text-xl lg:text-2xl mb-4 text-center">Nuevos NFC </h1>
    <form action="javascript:void(0);">
        <div class="xl:flex xl:space-x-2 my-2 items-center">
            <div class="w-full xl:w-1/4">
                <x-input_text label="Serie" name="serie" model="serie" oldValue="" placeholder="Serie" type="text" />
            </div>
            <div class="w-full xl:w-3/4 my-2">
                <x-input_select label="Tipo" name="type" model="type" oldValue="" placeholder="Tipo">
                    @foreach ($types as $typ)
                        <option value="{{ $typ['id'] }}">{{ $typ['text'] }}</option>
                    @endforeach
                </x-input_select>
            </div>
        </div>
        <div class="xl:flex xl:space-x-2 items-center">
            <div class="w-full xl:w-5/2 my-2" >
                <x-input_text label="Cantidad" name="cant" model="cant" oldValue="" placeholder="Cantidad" type="number" />
            </div>
                <div class="w-full xl:w-5/12 my-2">
                    <x-input_text label="Inicio" name="start" model="start" oldValue="" placeholder="Inicio"
                        type="number" />
                </div>
                <div class="w-full xl:w-2/12 my-2">
                    <x-jet-button wire:click="add"> Añadir</x-jet-button>
                </div>
        </div>
    </form>
    


</div>

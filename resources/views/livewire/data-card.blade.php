<div>
    {{-- Este componente debe recibir los siguientes valores
        $object=colección desde la tabla paginada.
        . --}}
    <div>
        <div class="mx-auto w-max mb-4 py-2 relative">
            <div class="-mt-1 -mr-1 text-white font-bold z-20 absolute top-3 right-2">
                <a href="{{ route($edit, $param) }}"><span
                        class="fas fa-pen text-md cursor-pointer hover:text-red-300" title="Editar"></span></a>
            </div>
            <div class="-mt-1 -mr-1 text-white font-bold z-20 absolute bottom-2 left-2">
                <span onclick="confirm('{{ $confirm }}') || event.preventDefault()"
                    class="{{ $status == 1 ? 'fas fa-trash text-red-500' : 'fas fa-recycle text-green-500' }} cursor-pointer"
                    wire:click="softdelete">
                </span>
            </div>
            <a class="block relative  max-w-xs w-80 h-36 bg-gray-100 px-3 py-2 rounded-md no-underline z-0 overflow-hidden card-1 cursor-pointer relative"
                href="{{ route($route, $param) }}">
                <h3 class="head text-xl font-bold"><span class="{{ $icon1 }} mr-2"></span>{{ $title }}
                </h3>
                <p class="parraf font-semibold text-gray-900 text-md">
                    <span><span class="{{ $icon }} mr-1"></span>{!! $title2 !!}</span> <br>
                    <span><span class="{{ $icon2 }} mr-1"></span>{{ $subtitle }}</span>
                </p>
                <div class="flex items-center absolute justify-center w-8 h-8 top-0 right-0 text-white"
                    style=" border-radius: 0 4px 0 32px; background-color:#293949;" href="#">

                </div>

                <div class="absolute right-2 bottom-2 flex div-icon items-center shadow-xl px-1">
                    <span class="{{ $icon3 }} cursor-pointer mx-1" id="sp-account">
                    </span> {!! $data1 !!}
                    <span class="fas fa-ellipsis-v mx-1"></span>
                    <span class="{{ $icon4 }} cursor-pointer mx-1">
                    </span>{!! $data2 !!}
                </div>
                <div class="flex items-center absolute justify-center w-8 h-8 bottom-0 left-0 text-white"
                    style=" border-radius: 0 32px  4px 0  ; background-color:#293949;" href="#">

                </div>
            </a>

        </div>

    </div>
</div>

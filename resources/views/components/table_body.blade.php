<div>
    <div class="bg-white pb-4 px-4 rounded-md w-full">
        <div class="flex justify-between w-full pt-6 ">
            <div class="w-full" id="div-title">
                <h1 class="text-center mx-auto uppercase font-bold text-lg lg:text-3xl"> {{ $title }}</h1>
            </div>
            <div class="flex">

             
                
            </div>
            
        </div>
        <div class="w-full flex justify-end  mt-2 lg:w-2/3 mx-auto">
            <div class="w-full sm:w-64 inline-block relative " id="div-search">
                <input type="search" name="" wire:model="search"
                    class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-4 rounded-lg"
                    placeholder="Search" />
                <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto mt-6 w-full">
            <table class="table-auto  lg:w-2/3 mx-auto">
                {{$thead}}
                <tbody class="text-md font-normal text-white">
                    @if ($object->count())
                        {{$slot}}
                    @else
                        <tr class=" border-b border-gray-200 hover:text-blue-200 py-10"
                            style="background-color: #293949">
                            <td class="px-4 py-4 border-b border-white text-center" colspan="5"
                                style="background-color: #293949">
                                <h2 class="font-bold uppercase text-lg select-none">No se ha encontrado ningún registro
                                </h2>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="lg:w-1/2 mx-auto hidden" id="div-form">
            @livewire('add-product')
        </div>
    </div>
    <div class="lg:w-1/2 mx-auto my-3" id="div-links">
        {{ $object->links() }}
    </div>

</div>
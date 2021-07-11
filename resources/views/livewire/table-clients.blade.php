<div>

    <div class="bg-white pb-4 px-4 rounded-md w-full bbg">
        {{-- Botones superiores --}}
        <div class="flex justify-between lg:w-1/2 pt-6 mx-auto ">
            <div class="" id="div-title">
                <h1 class="text-center mx-auto uppercase font-bold text-lg lg:text-3xl "> {{ $title }} </h1>
            </div>
            <div class="flex justify-end " id="div-botones">
                <div class="cursor-pointer mx-1 w-8 h-8 rounded-full flex items-center justify-center bg-gray-200"
                    id="btn-adduser">
                    <span class="fas fa-plus " id="sp-plus"></span>
                </div>
                @can('Gestionar Clientes', User::class)
                    <div wire:click="toggle"
                        class="cursor-pointer mx-1 w-8 h-8 rounded-full flex items-center justify-center bg-gray-200">
                        <span class="fas {{ $button }} "></span>
                    </div>
                @endcan
            </div>
        </div>
        {{-- Barra de búsqueda --}}
        <div class=" lg:w-1/2 mx-auto text-right py-1 mt-2 ">
            <div class="w-full sm:w-64 inline-block relative " id="div-search">
                <input type="search" name="" wire:model="search"
                    class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-4 rounded-lg"
                    placeholder="Buscar usuario..." />
                <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto mt-6 w-full" id="div-table">
            {{-- Tabla de usuarios --}}
            <table class="table-auto  lg:w-1/2 mx-auto">
                {{-- Cabecera de la tabla --}}
                <thead>
                    <tr class="rounded-lg text-sm font-medium text-gray-900 text-left uppercase"
                        style="font-size: 0.9674rem">
                        <th class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer relative select-none "
                            wire:click="toggleOrder('name')">Nombre Completo 
                            <span 
                            class="fas {{$order=='name' && $direction=="desc"? 'fa-sort-alpha-up-alt': ($order=='name'? 'fa-sort-alpha-down':'fa-sort')}} right-2 text-xl absolute">
                            </span>
                        </th>
                        <th class="px-4 py-2 bg-blue-100 border border-l-1 border-white select-none text-center">Teléfono
                        </th>
                        <th class="px-4 py-2 bg-blue-100 border border-l-1 border-white cursor-pointer select-none relative text-center"
                            wire:click="toggleOrder('debt')">Deuda 
                            <span 
                            class="fas {{$order=='debt' && $direction=="desc"? 'fa-sort-alpha-up-alt': ($order=='debt'? 'fa-sort-alpha-down':'fa-sort')}} right-2 text-xl absolute">
                            </span>
                        </th>
                       
                        <th class="py-2 bg-blue-100 text-center" colspan="2">Acciones</th>
                    </tr>
                </thead>
                {{-- Cuerpo de la tabla --}}
                <tbody class="text-md font-normal text-white rounded-xl border-none">
                    @if ($clients->count())
                        @foreach ($clients as $client)
                            <tr class=" border-b border-gray-200 hover:text-blue-200" style="background-color: #293949">
                                {{-- Detalles --}}
                                <td class="px-4 py-1 border border-l border-white">
                                    <span>{{ $client->name }}</span><br>
                                   {{--  <span class="select-none cursor-pointer" --}}
                                   {{--      wire:click="$set('place_id',{{ $client->place->id }})">{{ $client->place->name }}</span> --}}
                                </td>
                                <td class="px-4 py-1 border border-l border-white text-center">{{ $client->phone}}</td>
                                <td class="px-4 py-1 border border-l border-white text-center">{{ $client->debt }}</td>
                                
                                {{-- Acciones --}}
                                <td class="py-1 bg-blue-100 border-b border-white text-center"><a
                                        href="{{ route('users.show', $client) }}"><span
                                            class="fas fa-eye text-blue-500"></span></a></td>
                                <td class="py-1 bg-blue-100 border-b border-white text-center">
                                    <a role="button"
                                        onclick="confirm('{{ $confirm }}') || event.stopImmediatePropagation()"
                                        wire:click="softdelete('{{ $client->slug }}')">
                                        <span class="fas {{ $icon }}"
                                            title="{{ $icon == 'fa-trash text-red-500' ? 'Eliminar' : 'Restaurar' }}"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class=" border-b border-gray-200 hover:text-blue-200 py-10"
                            style="background-color: #293949">
                            <td class="px-4 py-4 border-b border-white text-center" colspan="5"
                                style="background-color: #293949">
                                <h2 class="font-bold uppercase text-lg select-none">No se ha encontrado ningún usuario
                                </h2>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="lg:w-1/2 mx-auto hidden" id="div-form">
            @livewire('add-client')
        </div>
    </div>
    <div class="lg:w-1/2 mx-auto my-3 mb" id="div-links">
        {{ $clients->links() }}
    </div>
</div>
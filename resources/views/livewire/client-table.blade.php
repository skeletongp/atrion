<div>

    <!-- component -->
    <div class="bg-white py-3 px-4 rounded-md w-full  ">
        {{-- Btn Papelera --}}
        <span class="fa {{$button}} cursor-pointer text-2xl" wire:click='toggle'></span>
        {{-- Btn  nuevo Usuario--}}
        <div class=" mx-auto">
            <x-modal modalId="md_add">
                @slot('title')
                    <span class="px-4 my-2"><span class="fas fa-plus font-bold"></span> Nuevo Usuario</span>
                @endslot
                <div class=" select-none " >
                    @livewire('add-user')
                </div>
              
            </x-modal>
        </div>

        <div class="  lg:w-2/3 mx-auto my-4 flex items-center justify-center ">
            <div class="flex border border-1 border-blue-200 rounded-md items-center w-11/12">
                <span
                    class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6 lg:w-1/6">Búsqueda:</span>
                <input name="search"
                    class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 lg:w-5/6 overflow-auto"
                    id="search" type="search" placeholder="Buscar producto" value="{{ old('search') }}"
                    wire:model.defer="search" />
            </div>
            <div>
                <span class="fas fa-search ml-2 text-xl cursor-pointer" wire:click="search" id="sp-search"></span>
            </div>
        </div>

        <div class=" mx-auto sm:px-6 lg:px-8 flex-1 justify-center ">
            <div>

                <div class="overflow-x-auto mt-3 select-none" style="height: 34rem">
                    <table class="table-auto  lg:w-2/3 mx-auto table">
                        <thead>
                            <tr class="bg-gray-900 text-base font-bold text-white text-left"
                                style="font-size: 0.9674rem">
                                <th class="px-4 py-2 cursor-pointer" wire:clicK="order('name')">Nombre
                                    <span class="fas {{ $order == 'name' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('email')">Correo
                                    <span class="fas {{ $order == 'email' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center ">Rol</th>
                                <th class="px-4 py-2  text-center cursor-pointer" wire:clicK="order('updated_at')">Registrado
                                    <span class="fas {{ $order == 'updated_at' ? $icon_order : 'fa-sort' }}"></span>
                                </th>
                                <th class="px-4 py-2  text-center " >Sucursal
                                    
                                </th>
                              
                                <th class="py-2  text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-900">
                            @foreach ($users->chunk(50) as $array)
                                @foreach ($array as $user)
                                    <tr
                                        class="hover:bg-blue-100 border-b border-white hover:border-gray-200 py-4 text-base">
                                        <td class="px-4 py-2 lg:w-72 lg:max-w-72 cursor-pointer"><a href="{{route('users_show',$user)}}">{{ $user->name }}</a></td>
                                        <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                                        <td class="px-4 py-2 text-center">{{ $user->getRoleNames()[0] }}</td>
                                        <td class="px-4 py-2 text-center">{{ substr($user->created_at,0,10)}}</td>
                                        <td class="px-4 py-2 text-center">{{ $user->place->name  }}</td>
                                        <td class="px-2  text-center">
                                            <x-modal modalId="edit{{ $user->id }}">
                                                <x-slot name="title">
                                                    <span class="fas fa-pen mx-2"></span>
                                                </x-slot>
                                                @livewire('edit-user', ['user' => $user], key($user->id))
                                            </x-modal>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <span class="fas {{$icon}} text-red-400 cursor-pointer"
                                                onclick="confirm('{{$confirm}}')|| event.stopImmediatePropagation()"
                                                wire:click="softdelete('{{ $user->slug }}')">
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="py-2 lg:w-2/3 mx-auto  text-red-400">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
    <style>
        thead tr th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        thead tr th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        tbody tr td:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 0px;
        }

        tbody tr td:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 0px;
        }


        tr:nth-child(2n) {
            background: #a3d1e0
        }

        tr:nth-child(2n+3) {
            background: #fff
        }

        .table {
            transition: all 1s ease-in-out;
            
        }
        
    </style>
    <script>
        $('#search').on('keypress', function(e) {
            if (e.which == 13) {
                $('#sp-search').trigger('click');
            }
        });
        $('#search').change(function(e) {
            if ($.trim($('#search').val().length == 0)) {

                $('#sp-search').trigger('click');
            }
        });
    </script>
</div>

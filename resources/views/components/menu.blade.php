<div>
    <label for="input-menu" id="lb-open"
        class=" top-3 left-2 lb-open cursor-pointer flex-1 items-center justify-center hidden fixed" style="z-index:80">
        <span class="fas fa-bars text-2xl text-blue-600" id="sp-menu-open"></span>
    </label>
    <label for="input-menu" id="lb-close"
        class=" top-3 left-52 lb-close cursor-pointer flex-1 items-center justify-center fixed 2xl:hidden"
        style="z-index:80">
        <span class="fas fa-times text-2xl text-blue-600" id="sp-menu-close"></span>
    </label>
    <input type="checkbox" name="input-menu" id="input-menu" class="absolute bottom-16 right-4 hidden" checked>
    <aside class="sidebar {{-- menu-close --}}" id="sidebar">

        <div id="leftside-navigation" class="nano">

            <ul class="nano-content">
                <li class="flex justify-between items-center h-24 ">
                    <a href="{{ route('user.company') }}"
                        style="display: flex !important; justify-contents: center; 	align-items: center">
                        <div class="w-10 h-10 bg-cover rounded-full mr-1 shadow-xl border-2 border-blue-300"
                            style="background-image: url('{{ \App\Models\Company::get()->first()->logo }})'"></div>
                        <span
                            class="w-6/12 uppercase font-bold overflow-hidden truncate ">{{ \App\Models\Company::get()->first()->name }}
                            para ves más</span>
                    </a>
                </li>
                <li class="flex justify-between items-center">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Panel</span></a>
                </li>
                {{-- Cuenta Principal --}}
                <li class="sub-menu {{ request()->is('account/*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Mi cuenta</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li class="{{ request()->routeIs('users_show') ? 'active' : '' }}"><a
                                href="{{ route('users_show', Auth::user()) }}"><i class="fas fa-user"></i><span>Mi
                                    perfil</span></a>
                        </li>
                        @role('Admin')
                        <li class="{{ request()->routeIs('user.show') ? 'active' : '' }}"><a
                                href="{{ route('user.company', Auth::user()) }}"><i class="fas fa-city"></i>
                                <span>Empresa</span></a>
                        </li>
                        @endrole
                        <li class="{{ request()->is('account/outcomes*') ? 'active' : '' }}">
                            <form method="POST" action="{{ route('logout') }}" id="form">
                                @csrf

                                <a type="submit" id='sub'
                                    class="underline text-sm text-gray-600 hover:text-gray-900 cursor-pointer">
                                    <span class=""><i class="fas fa-sign-out-alt"></i><span>Salir</span></span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
                {{-- Área de facturación --}}
                @can('Vender', User::class)
                    <li class="sub-menu {{ request()->is('invoice/*') ? 'active' : '' }}">
                        <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Facturación</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="{{ route('sale', 1) }}"><i
                                        class="fas fa-file-invoice-dollar"></i><span>Cotizar</span></a>
                            </li>
                            <li class="{{ request()->is('invoice/sale*') ? 'active' : '' }}"><a
                                    href="{{ route('sale') }}"><i
                                        class="fas fa-file-invoice"></i><span>Facturar</span></a>
                            </li>
                            <li class="{{ request()->is('invoice/invoices*') ? 'active' : '' }}"><a
                                    href="{{ route('invoices') }}"><i
                                        class="fas fa-refresh"></i><span>Facturas</span></a>
                            </li>
                            <li class="{{ request()->is('invoice/cotizes*') ? 'active' : '' }}"><a
                                    href="{{ route('cotizes') }}"><i
                                        class="fas fa-refresh"></i><span>Cotizaciones</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                
                {{-- Sección de personas --}}
                <li class="sub-menu {{ request()->is('persons/*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"><i class="fa fa fa-users"></i><span>Personas</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>

                        @can('Gestionar Clientes', User::class)
                            <li
                                class="{{ request()->routeIs('clients_*') && !request()->routeIs('clients_trash') ? 'active' : '' }}">
                                <a href="{{ route('clients_index') }}"><i
                                        class="fas fa-user"></i><span>Clientes</span></a>
                            @endcan
                        </li>
                        <li><a href="{{ route('providers_index') }}"><i
                                    class="fas fa-user-tag"></i><span>Proveedores</span></a>
                        </li>
                        @can('Gestionar Usuarios', User::class)
                            <li class="{{ request()->routeIs('users_*') ? 'active' : '' }}"><a
                                    href="{{ route('users_index') }}"><i
                                        class="fas fa-user-tie"></i><span>Usuarios</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
                @can('Gestionar Productos', User::class)
                    <li class="sub-menu {{ request()->is('inventory/*') ? 'active' : '' }}">
                        <a href="javascript:void(0);"><i class="fas fa-cubes"></i><span>Inventario</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>

                            @can('Gestionar Productos', User::class)
                                <li class="{{ request()->routeIs('products_index') ? 'active' : '' }}"><a
                                        href="{{ route('products_index') }}"><i
                                            class="fas fa-tags"></i><span>Productos</span></a>
                                </li>
                            @endcan

                            @can('Gestionar Ingresos', User::class)
                                <li class="{{ request()->routeIs('products_value') ? 'active' : '' }}"><a
                                        href="{{ route('products_value') }}"><i
                                            class="fas fa-dollar-sign"></i><span>Valor</span></a>
                                </li>

                            @endcan
                            @can('Gestionar Sucursales', User::class)
                                <li><a href="{{ route('places_index') }}"><i
                                            class="fas fa-store-alt"></i><span>Sucursales</span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan
                @can('Gestionar Ingresos', User::class)
                    <li class="sub-menu ">
                        <a href="javascript:void(0);"><i class="fas fa-arrow-down"></i><span>Ingresos</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li class="active"><a href="mail-inbox.html"><i
                                        class="fas fa-chart-line"></i><span>Ventas</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sync-alt"></i><span>Recurrentes</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sticky-note"></i><span>Otros</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Gestionar Egresos', User::class)
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fas fa-arrow-up"></i><span>Egresos</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li class="active"><a href="{{route('outcome_index')}}"><i
                                        class="fas fa-cart-arrow-down"></i><span>Compras</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sync-alt"></i><span>Recurrentes</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sticky-note"></i><span>Otros</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
               
                @can('Gestionar Ingresos', User::class)
                    <li class="sub-menu ">
                        <a href="javascript:void(0);"><i class="fas fa-donate"></i><span>Contabilidad</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li class="active"><a href="{{ route('fiscal_index') }}"><i
                                        class="fas fa-chart-line"></i><span>Comprobantes</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sync-alt"></i><span>Recurrentes</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sticky-note"></i><span>Otros</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fas fa-question"></i><span>Ayuda</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li><a href="pages-blank.html"><i class="fas fa-info-circle"></i><span>Guía</span></a>
                        </li>
                        <li><a href="pages-login.html"><i class="fas fa-at"></i><span>Contacto</span></a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </aside>
    <script>
        window.addEventListener('load', function() {
            var button = document.getElementById('sub');
            button.onclick = function() {
                document.getElementById("form").submit();
            }
        })
    </script>

</div>

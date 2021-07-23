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
                <li class="flex justify-between items-center">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Panel</span></a>
                </li>
                <li class="sub-menu {{ request()->is('account/*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Mi cuenta</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li class="{{ request()->routeIs('user.show') ? 'active' : '' }}"><a
                                href="{{ route('user.show', Auth::user()) }}"><i class="fas fa-user"></i><span>Mi
                                    perfil</span></a>
                        </li>
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
                @can('Vender', User::class)
                    <li class="sub-menu {{ request()->is('invoice/*') ? 'active' : '' }}">
                        <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Facturación</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="{{ route('preview', 'NCF00000001') }}"><i
                                        class="fas fa-file-invoice-dollar"></i><span>Cotizar</span></a>
                            </li>
                            <li class="{{ request()->is('invoice/sale*') ? 'active' : '' }}"><a
                                    href="{{ route('sale') }}"><i
                                        class="fas fa-file-invoice"></i><span>Facturar</span></a>
                            </li>
                            <li class="{{ request()->is('invoice/invoices*') ? 'active' : '' }}"><a
                                    href="{{ route('invoices') }}"><i
                                        class="fas fa-refresh"></i><span>Historial</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Comprar', User::class)
                    <li class="sub-menu ">
                        <a href="javascript:void(0);"><i class="fa fa-cart-arrow-down"></i><span>Compras</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="tables-basic.html"><i
                                        class="fas fa-file-invoice-dollar"></i><span>Comprar</span></a>
                            </li>
                            <li><a href="tables-basic.html"><i class="fas fa-file-invoice"></i><span>Registrar</span></a>
                            </li>

                        </ul>
                    </li>
                @endcan
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
                        <li><a href="forms-mask.html"><i class="fas fa-user-tag"></i><span>Proveedores</span></a>
                        </li>
                        @can('Gestionar Usuarios', User::class)
                            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><a
                                    href="{{ route('users.index') }}"><i
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
                                <li class="{{ request()->routeIs('products_*') ? 'active' : '' }}"><a
                                        href="{{ route('products_index') }}"><i
                                            class="fas fa-tags"></i><span>Productos</span></a>
                                </li>
                            @endcan
                            
                            @can('Gestionar Ingresos', User::class)
                                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><a
                                        href="{{ route('users.index') }}"><i
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
                            <li class="active"><a href="mail-inbox.html"><i
                                        class="fas fa-cart-arrow-down"></i><span>Compras</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sync-alt"></i><span>Recurrentes</span></a>
                            </li>
                            <li><a href="mail-compose.html"><i class="fas fa-sticky-note"></i><span>Otros</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('Gestionar Cuentas', Model::class)
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fas fa-dollar-sign"></i><span>Contabilidad</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="map-google.html"><i class="fas fa-arrow-down"></i><span>Cta. por
                                        Cobrar</span></a>
                            </li>
                            <li><a href="map-vector.html"><i class="fas fa-arrow-up"></i><span>Cta. por
                                        Pagar</span></a>
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

    <div>
        <div class="min-h-screen min-w-screen hidden div-all ">

        </div>
        <label for="input-menu" id="lb-menu"
            class="absolute top-3 left-48 lb-menu cursor-pointer flex-1 items-center justify-center lg:hidden"
            style="z-index:70">
            <span class="fas fa-times text-2xl text-blue-600" id="sp-menu"></span>
        </label>
        <input type="checkbox" name="input-menu" id="input-menu" class="absolute bottom-16 right-4 hidden" checked>
        <aside class="sidebar {{-- menu-close --}}" id="sidebar">
            <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
            <script src="{{ asset('js/menu.js') }}"></script>
            <div id="leftside-navigation" class="nano">
                <ul class="nano-content">
                    <li class="flex justify-between items-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i><span>Panel</span></a>
                    </li>
                    <li class="sub-menu {{ request()->is('account/*') || request()->is('user/*') ? 'active' : '' }}">
                        <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Mi cuenta</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li class="{{ request()->routeIs('users.show') ? 'active' : '' }}"><a
                                    href="{{ route('users.show', Auth::user()) }}">Perfil de usuario</a>
                            </li>
                            @can('manage.users', User::class)
                                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><a
                                        href="{{ route('users.index') }}">Gestionar Usuarios</a>
                                </li>
                            @endcan

                            @can('manage.places', User::class)
                                <li class="{{ request()->is('account/places*') ? 'active' : '' }}"><a
                                        href="ui-alerts-notifications.html">Gestionar Sucursales</a>
                                </li>
                            @endcan
                            @can('manage.incomes', User::class)
                                <li class="{{ request()->is('account/incomes*') ? 'active' : '' }}"><a
                                        href="ui-alerts-notifications.html">Reportes de Ingresos</a>
                                </li>
                            @endcan
                            @can('manage.outcomes', User::class)
                                <li class="{{ request()->is('account/outcomes*') ? 'active' : '' }}"><a
                                        href="ui-alerts-notifications.html">Reportes de Gastos</a>
                                </li>
                            @endcan
                            <li class="{{ request()->is('account/outcomes*') ? 'active' : '' }}">
                                <form method="POST" action="{{ route('logout') }}" id="form">
                                    @csrf

                                    <a type="submit" id='sub'
                                        class="underline text-sm text-gray-600 hover:text-gray-900 cursor-pointer">
                                        <span class="">Salir</span>
                                    </a>
                                </form>
                            </li>


                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Facturación</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="tables-basic.html">Nueva factura</a>
                            </li>
                            <li><a href="tables-basic.html">Nueva cotización</a>
                            </li>
                            <li><a href="tables-data.html">Historial de facturación</a>
                            </li>
                            <li><a href="tables-data.html">Historial de cotización</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa fa-tasks"></i><span>Forms</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="forms-components.html">Components</a>
                            </li>
                            <li><a href="forms-validation.html">Validation</a>
                            </li>
                            <li><a href="forms-mask.html">Mask</a>
                            </li>
                            <li><a href="forms-wizard.html">Wizard</a>
                            </li>
                            <li><a href="forms-multiple-file.html">Multiple File Upload</a>
                            </li>
                            <li><a href="forms-wysiwyg.html">WYSIWYG Editor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu ">
                        <a href="javascript:void(0);"><i class="fa fa-envelope"></i><span>Mail</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li class="active"><a href="mail-inbox.html">Inbox</a>
                            </li>
                            <li><a href="mail-compose.html">Compose Mail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-bar-chart-o"></i><span>Charts</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="charts-chartjs.html">Chartjs</a>
                            </li>
                            <li><a href="charts-morris.html">Morris</a>
                            </li>
                            <li><a href="charts-c3.html">C3 Charts</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-map-marker"></i><span>Maps</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="map-google.html">Google Map</a>
                            </li>
                            <li><a href="map-vector.html">Vector Map</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="typography.html"><i class="fa fa-text-height"></i><span>Typography</span></a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-file"></i><span>Pages</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="pages-blank.html">Blank Page</a>
                            </li>
                            <li><a href="pages-login.html">Login</a>
                            </li>
                            <li><a href="pages-sign-up.html">Sign Up</a>
                            </li>
                            <li><a href="pages-calendar.html">Calendar</a>
                            </li>
                            <li><a href="pages-timeline.html">Timeline</a>
                            </li>
                            <li><a href="pages-404.html">404</a>
                            </li>
                            <li><a href="pages-500.html">500</a>
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

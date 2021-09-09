<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
    <link rel="stylesheet" href="{{ mix('css/center-atom.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @laravelPWA


</head>

<body class="font-sans antialiased h-screen">
    <x-jet-banner />
    @php
    date_default_timezone_set('America/Santo_Domingo');
    // Unix
    setlocale(LC_ALL, 'es_ES.UTF-8');

    @endphp
    <div class=" mx-auto bg-gray-100" id="body">

        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow fixed w-full top-0 left-0 " style="z-index: 60">
            <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="lg:ml-56 w-full uppercase">
                    {{ $header }}
                </div>
                {{-- Funciones del perfil --}}
                <label class="flex  text-gray-900 uppercase font-bold items-center space-x-2 w-1/2 justify-end " for="openProfile">
                    <a href="{{ url()->previous() }}" class="absolute top-1 right-2 "><span
                            class="fas fa-angle-double-left text-2xl"></span></a>
                    <div class="flex items-center space-x-2 " id="profile-photo">
                        <a href="{{ route('users_show', Auth::user()) }}" class=" w-12 h-12 rounded-full">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt=""
                                class=" rounded-full mr-2 ">
                        </a>
                        <span class="hidden lg:block cursor-pointer">{{ Auth::user()->name }}</span>
                    </label>
                    <input type="checkbox" id="openProfile" name="openProfile" class="hidden">
                    <div
                        class="fixed -top-8 right-2 lg:left-auto opacity-0 div-perfil px-2 py-1 z-20 bg-white rounded-md">
                        <a href="{{ route('users_show', Auth::user()) }}"><span class="fas fa-user"></span>
                            Perfil</a><br>
                        <form method="POST" action="{{ route('logout') }}" id="form2">
                            @csrf
                            <a type="submit" id='sub2' class=" text-gray-900 hover:text-gray-900 cursor-pointer">
                                <span class=""><i class="fas fa-sign-out-alt  "></i><span
                                        class="font-bold ml-1">Salir</span></span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </header>
        @endif

        <!-- Cuerpo de la página -->
        <main class="bg-gray-900" style="max-height: 100vh !important; min-height:100vh" id="main">

            <div class="bg-gray-900 w-screen overflow-hidden">
                <div class=" max-w-screen sm:px-2 lg:pl-8 bg-white  py-24 overflow-y-auto"
                    style="height: 100vh; max-height:100vh">
                    <div class="bg-white shadow-xl sm:rounded-lg max-w-screen-2xl ml-auto lg:mr-12 py-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('modals')
    @stack('js')
    @livewireScripts
    <script src="{{ mix('js/main.js') }}" defer></script>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>


</html>
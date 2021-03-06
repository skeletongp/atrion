<div>
    {{-- Valida si ha una caja para ese usuario con la fecha de hoy --}}
    <div class="mx-auto my-2">
        @if (session('error'))
        <span class="text-red-600 font-bold text-lg">{{ session('error') }}
            @role('Admin')
            <span class="font-bold text-lg space-x-2 text-white bg-gray-900 px-3 py-1 rounded-xl cursor-pointer"
                wire:click="reopen({{ $cash }})">
                <span class="fas fa-lock-open"></span>
                ¿Reabrir?</span>
            @endrole
            @endif
            @if (session('cashOut'))
            <span class="text-red-600 font-bold text-lg">{{ session('cashOut') }}

                @endif
            </span>
    </div>
    @if ($cash && $cash->status == 1)
    <div class="relative pt-2 ">
        <div class="absolute top-0 left-2">
            @if ($cash->invoices->count())
            <div
                class="inline-flex items-center bg-white leading-none text-blue-500 rounded-full p-2 shadow text-teal text-sm">
                <span
                    class="inline-flex bg-blue-300 text-black font-bold rounded-full h-6 px-3 justify-center items-center text-md">Última
                    Factura:</span>
                <span class="inline-flex px-2 font-bold md:text-lg"> <a class="capitalize "
                        href="{{ route('preview', $cash->invoices->last()) }}">{{ $cash->invoices->last()->client->name }}</a></span>
            </div>
            @endif
        </div>
        <br>
        <div class="relative">

            <div class="mx-auto text-center">
                <div
                    class="inline-flex items-center bg-white leading-none text-blue-500 rounded-full p-2 shadow-xl  text-sm">
                    <span
                        class="inline-flex bg-blue-300 text-black font-bold rounded-full h-6 px-3 justify-center items-center ">{{ date('d-m-Y') }}</span>
                    <span class="inline-flex px-2 font-bold md:text-2xl md:uppercase"> Detalles de Caja</a></span>
                </div>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3 mx-3 px-2 md:mx-2 py-3" id="base">
                @livewire('panel-data',
                [
                'title'=>'Saldo Inicial',
                'value'=>$cash->start,
                'icon1'=>'fas fa-coins text-white',
                'icon2'=>'fas fa-dollar-sign text-green-800 last',
                'bg1'=>'bg-blue-100 hover:bg-blue-400',
                'bg2'=>'bg-blue-900',
                ], key(1))
                
                
                @livewire('panel-data',
                [
                'title'=>'Dinero en Caja',
                'value'=>$cash->end,
                'icon1'=>'fas fa-dollar-sign text-white',
                'icon2'=>'fas fa-dollar-sign text-green-800',
                'bg1'=>'bg-green-300 hover:bg-blue-400',
                'bg2'=>'bg-green-700',
                ], key(2))

               
                @livewire('panel-data',
                [
                'title'=>'Ingreso Real',
                'value'=>$cash->incomes->sum('amount'),
                'icon1'=>'fas fa-dollar-sign text-white',
                'icon2'=>'fas fa-dollar-sign text-green-800',
                'bg1'=>'bg-green-300 hover:bg-blue-400',
                'bg2'=>'bg-green-700',
                ], key(5))
            </div>
            <span class="absolute top-2 right-2 font-bold uppercase text-lg cursor-pointer"
                onclick="confirm('¿Desea cerrar la caja?')||event.stopImmediatePropagation()" wire:click="close">
                <span class="fas fa-lock mx-1"></span>
                <span class="hidden md:inline-block"> Cerrar Caja</span>
            </span>
        </div>
    </div>
    @else
    <div class="lg:flex items-center justify-between py-12 max-w-2xl mx-auto text-center">
        <div>
            <img src="{{ $user->profile_photo_url }}" alt="avatar" class="w-48 h-48 rounded-full mx-auto my-4">
        </div>
        <div class="flex flex-col items-center justify-center  my-4 py-2 px-2 relative" wire:ignore>
            <h1 class="text-2xl text-center font-bold p-4 uppercase rounded-full">
                Bienvenido, {{ $user->name }}</h1>
            <x-modal :modalId="'modal'.$user->id">
                <x-slot name="title">
                    <div class=" w-72 uppercase font-bold text-2xl  rounded-full px-8 py-2 cursor-pointer mx-auto"
                        wire:click='confirmar ({{ $cash }})'>
                        <span class="fas fa-lock-open"></span>Abrir Caja
                    </div>
                </x-slot>
                <div class="block">
                    <x-input_text name="amount" model="amount" oldValue="" placeholder='Balance Inicial' label="Balance"
                        type="number"></x-input_text>
                    <x-jet-input-error for="amount"></x-jet-input-error>
                    <x-jet-button class="my-2 text-xl" id="btnAbrir" wire:click="open ({{ $cash }})">Abrir
                    </x-jet-button>
                </div>
            </x-modal>
        </div>
    </div>
    <button class="hidden" id="btn-reopen"
        onclick="confirm('La caja de hoy fue cerrada. ¿Desea reabrirla?')||event.stopInmediatePropagation()"
        wire:click="reopen({{ $cash }})"></button>
    @endif
    <div class="flex justify-start w-full mx-12 h-96">
        <x-sales_chart ></x-sales_chart>
    </div>
</div>
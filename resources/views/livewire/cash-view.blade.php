<div>
    @if ($cash)
    {{$cash->user}}
    @else
    <div class="lg:flex items-center justify-between py-12 max-w-2xl mx-auto text-center">
        <div>
            <img src="{{$user->profile_photo_url}}" alt="avatar" class="w-48 h-48 rounded-full mx-auto my-4">
        </div>
        <div class="flex flex-col items-center justify center my-4">
            <h1 class="bg-indigo-900 text-2xl text-center text-white font-bold p-4 uppercase rounded-full">Bienvenido, {{$user->name}}</h1>
        <x-jet-button class="text-xl my-8 bg-indigo- rounded-full"><span class="fas fa-lock-open"></span> Abrir Caja</x-jet-button>
        </div>
    </div>
    @endif
</div>

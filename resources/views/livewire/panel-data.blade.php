<div class="sortable max-w-md min-w-full mx-auto">
    <div
        class="shadow-xl rounded-xl w-full h-36 flex items-center {{ $bg1 }} border-b-8 border-l-2 border-gray-900 border-opacity-20 cursor-pointer expand">
        <div class="w-28 h-28 rounded-full mx-1 flex items-center justify-center relative {{ $bg2 }}">
            <span class="{{ $icon1 }} text-6xl shadow-xl"></span>
        </div>
        <div class="w-9/12  h-full flex flex-col items-center justify-center ">
            <h1 class="uppercase text-2xl font-bold">{{ $title }}</h1>
            <h1 class="uppercase text-xl font-bold">{{ $value }} <span class="{{ $icon2 }}"></span></h1>

        </div>
    </div>
    <style>
        .expand {
            transition: all 0.4s ease-in-out;
        }

        .expand:hover {
            transform: scale(1.04)
        }

    </style>
   
</div>

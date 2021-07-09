<div>
    <div class="flex items-center border border-1 border-blue-200 rounded-md pr-1">
        <span
            class="text-sm rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6">{{ $label }}:</span>
        <select
            class="text-center border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm w-4/6 overflow-auto w-full select_2"
            name="{{ $name }}" id="" wire:model.defer="{{ $model }}">
            <option value="">{{ $placeholder }}</option>
            {{ $slot }}
        </select>
        <div>
            @if (isset($button))
                {{ $button }}
            @endif
        </div>
    </div>
    
</div>

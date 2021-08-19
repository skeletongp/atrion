<div>
    <div class="flex border border-1 border-blue-200 rounded-md items-center">
        <span
            class="text-sm border-none rounded-l px-2 font-bold py-2 bg-white whitespace-no-wrap w-2/6">{{ $label }}:</span>
        <input name="{{ $name }}"
            
            class=" border-none outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6 overflow-auto"
            type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ old($name, $oldValue) }}"
            {{ isset($readonly) && $readonly == true ? 'readonly' : ' ' }} wire:model.defer="{{ $model }}" min="0"/>
    </div>
</div>

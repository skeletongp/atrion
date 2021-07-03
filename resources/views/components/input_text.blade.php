<div>
    <div class="flex ">
        <span
            class="text-sm border border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">{{$label}}:</span>
        <input name="{{$name}}"
            class=" border-l-0  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
            type="{{$type}}" placeholder="{{$placeholder}}" value="{{ old($name, $oldValue) }}"
            {{isset($readonly) && $readonly==true?'readonly':' '}} wire:model.defer="{{$model}}"/>
    </div>
</div>
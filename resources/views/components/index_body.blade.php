<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <!-- Componentes con los datos -->
        @if ($object->count())
            {{ $slot }}
        @else
            <h1 class="text-xl text-center">No se encontraron registros válidos</h1>
        @endif
    </div>
    <div class="px-8">
        {!! $object->appends(\Request::except('page'))->render() !!}
    </div>
</div>

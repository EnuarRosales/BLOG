@extends('template.index')

@section('tittle-tab')
    Reporte de Producidos-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.registroProducidos.index') }}">Reporte de Producidos</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Registrar Producido</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form method="POST" action="{{ route('admin.registroProducidos.store') }}">
                @csrf
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ now()->format('Y-m-d') }}"
                        class="form-control">
                    @error('fecha')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror


                    <label for="valorProducido">Valor Producido</label>
                    <input type="number" name="valorProducido" id="valorProducido" step="0.001" class="form-control">
                    @error('valorProducido')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="pagina_id">Pagina</label>
                    <select name="pagina_id" id="pagina_id" class="form-control">
                        <option value="">Selecciona una página</option>
                        @foreach ($paginas as $pagina)
                            <option value="{{ $pagina->id }}">{{ $pagina->nombre }}</option>
                        @endforeach
                    </select>
                    @error('pagina_id')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="meta_id">Meta</label>
                    <select name="meta_id" id="meta_id" class="form-control">
                        <option value="">Selecciona una meta</option>
                        {{-- @foreach ($metas as $meta) --}}
                        <option value="{{ $meta->id }}">{{ $meta->nombre }}</option>
                        {{-- @endforeach --}}
                    </select>
                    @error('meta_id')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Registrar Producido</button>
            </form>
        </div>
    </div>
@stop

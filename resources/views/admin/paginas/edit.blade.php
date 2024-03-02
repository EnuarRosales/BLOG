@extends('template.index')

@section('tittle-tab')
    Configuracion-Paginas-Edit
@endsection

@section('page-title')
    <a href="{{ route('admin.paginas.index') }}"> Configuracion-Paginas</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Editar páginas</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form action="{{ route('admin.paginas.update', $pagina) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Favor ingrese una página" value="{{ $pagina->nombre }}">
                    @error('nombre')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="moneda">Moneda</label>
                    <select name="moneda" id="moneda" class="form-control">
                        <option value="dolar" {{ $pagina->moneda == 'dolar' ? 'selected' : '' }}>dolar</option>
                        <option value="euro" {{ $pagina->moneda == 'euro' ? 'selected' : '' }}>euro</option>
                    </select>
                    @error('moneda')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" class="form-control" placeholder="Favor ingrese un valor" pattern="^(\d+)?(?:\.\d{1,2})?$" title="Ingrese un número válido no se puede usar la (,) (puede tener hasta dos decimales)" value="{{ $pagina->valor }}">
                    @error('valor')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Página</button>
            </form>
        </div>
    </div>
@stop

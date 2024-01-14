@extends('template.index')

@section('tittle-tab')
    Reporte de paginas
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de paginas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar Reporte</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form id="miFormulario" method="POST" action="{{ route('admin.reportePaginas.update', $reportePagina) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" value="{{ $reportePagina->fecha }}" class="form-control">
                    @error('fecha')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="user_id">Modelo</label>
                    <select name="user_id" class="form-control" id="user_id">
                        <option value="">Seleccione Un Usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $user->id == $reportePagina->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="pagina_id">Pagina</label>
                    <select name="pagina_id" class="form-control" id="pagina_id">
                        <option value="">Seleccione Una Pagina</option>
                        @foreach ($paginas as $pagina)
                            <option value="{{ $pagina->id }}"
                                {{ $pagina->id == $reportePagina->pagina_id ? 'selected' : '' }}>
                                {{ $pagina->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('pagina_id')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="Cantidad">Cantidad</label>
                    <input type="number" name="Cantidad" value="{{ $reportePagina->Cantidad }}" class="form-control">
                    @error('Cantidad')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="TRM">TRM</label>
                    <input type="number" name="TRM" value="{{ $reportePagina->TRM }}" class="form-control">
                    @error('TRM')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <div class="form-group row">
                        <div class="form-group col-12" id="porcentaje" style="display: none;">
                            <label for="operacion">Operación</label>
                            <select name="operacion" class="form-control">
                                <option value="" {{ $reportePagina->operacion == '' ? 'selected' : '' }}>Selecciona
                                    una opción</option>
                                <option value="-" {{ $reportePagina->operacion == '-' ? 'selected' : '' }}>-</option>
                                <option value="+" {{ $reportePagina->operacion == '+' ? 'selected' : '' }}>+</option>
                            </select>

                            <label for="porcentaje_add">Procentaje a Modioficar</label>
                            <input type="number" name="porcentaje_add" value="{{ $reportePagina->porcentaje_add }}"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </form>

            <div class="form-group row">

                <div class="col-2">
                    <button class="btn btn-secondary" id="togglePorcentaje">
                        Modificar Porcentaje
                        <i class="fas fa-chevron-circle-down ml-2"></i>
                    </button>
                </div>

                <div class="col-2">
                    <button type="button" id="btnGuardarEdicion" class="btn btn-primary">Guardar Edicion</button>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <script>
        $(document).ready(function() {
            $("#togglePorcentaje").click(function() {
                $("#porcentaje").toggle(); // Alternar la visibilidad del div de porcentaje
            });

            $("#btnGuardarEdicion").click(function() {
                $("#miFormulario").submit();
            });
        });
    </script>
@endsection

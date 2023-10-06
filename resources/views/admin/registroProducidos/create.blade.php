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
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-header">
                    @yield('content_header')
                </div>
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.registroProducidos.store']) !!}
                    <div class="form-group">
                        {{-- {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror --}}


                        {!! Form::label('fecha', 'Fecha') !!}
                        {!! Form::date('fecha', now(), [
                            'class' => 'form-control',
                        ]) !!}
                        @error('fecha')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('valorProducido', 'Valor Producido') !!}
                        {!! Form::number('valorProducido', null, [
                            'class' => 'form-control',
                        ]) !!}
                        @error('valorProducido')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror


                        {!! Form::label('pagina_id', 'Pagina') !!}
                        {!! Form::select('pagina_id', $paginas->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Una Pagina',
                        ]) !!}
                        @error('pagina_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('meta_id', 'Meta') !!}
                        {!! Form::select('meta_id', $metas->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Una Meta',
                        ]) !!}
                        @error('meta_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Registrar Producido', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>


@stop

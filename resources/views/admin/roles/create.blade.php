@extends('template.index')

@section('tittle-tab')
    Configuracion-Paginas-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.roles.index') }}"> Roles</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Crear Rol</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-body"> --}}

                    {!! Form::open(['route' => 'admin.roles.store']) !!}
                    {{-- reutilizacdiond de codigo gracias al partial ya que se va a usar en varias partes --}}
                    @include('admin.roles.partials.form')


                    {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>
@stop

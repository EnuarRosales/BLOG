{{-- <div class="form-group">

    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el nombre']) !!}
    @error('name')
        <br>
        <span class="text-danger">{{ $message }}</span>
        <br>
    @enderror
</div> --}}

{{--
<div class="card">
    <div class="card-body"> --}}
        {!! Form::open(['route' => 'admin.abonos.store']) !!}

        <div class="form-group">
            {!! Form::label('descuento_id', 'ID Descuento') !!}
            {{-- {!! Form::select('id', $abonoParcial->pluck('id', 'id'), null,['class' => 'form-control','placeholder' ,'readonly'=> 'Seleccione Un Usuario']) !!} --}}
            {!! Form::number('descuento_id', $abonoParcial->id, [
                'class' => 'form-control',
                'readonly',
            ]) !!}

            @error('descuento_id')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror

            {!! Form::label('valor', 'Valor') !!}
            {!! Form::number('valor', null, [
                'class' => 'form-control', 'placeholder' => 'Favor ingrese un valor'
            ]) !!}

            @error('valor')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror

            {!! Form::label('descripcion', 'Descripcion') !!}
            {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una descripcion']) !!}
            @error('descripcion')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror





            {{-- {!! Form::label('montoDescuento', 'Monto Descuento') !!}
            {!! Form::number('montoDescuento',null, [
                'class' => 'form-control',
            ]) !!}
            @error('montoDescuento')
                <br>
                <span class="text-danger">{{$message}}</span>
                <br>
            @enderror  --}}




            {{-- {!! Form::label('created_at', 'Fecha') !!}
            {!! Form::select($registroAsistencia->created_at, null, ['class' => 'form-control','placeholder' => 'Seleccione Un Usuario']) !!}
            @error('created_at')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror  --}}

        </div>
        {!! Form::submit('Realizar abono', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    {{-- </div>
</div> --}}

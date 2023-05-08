<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el nombre']) !!}
    @error('name')
        <br>
        <span class="text-danger">{{ $message }}</span>
        <br>
    @enderror
</div>

<h2 class="h3">Lista de Permisos</h2>

@foreach ($permissions as $permission)
    <div>
        <label>
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
            {{ $permission->description }}
        </label>
    </div>
@endforeach

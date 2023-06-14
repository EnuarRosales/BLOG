@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>
@endsection

@section('content')
    <div class="card">
        <form action="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Información</h4>
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="nit" class="form-label">Nit</label>
                            <input type="text" class="form-control" id="nit">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        <div class="form-group">
                            <label for="representative" class="form-label">Representate</label>
                            <input type="text" class="form-control" id="representative">
                        </div>
                        <div class="form-group">
                            <label for="representative_identification_card" class="form-label">Identificación del representate</label>
                            <input type="text" class="form-control" id="representative_identification_card">
                        </div>
                        <div class="form-group">
                            <label for="representative_identification_card" class="form-label">Numero de Rooms</label>
                            <input type="text" class="form-control" id="representative_identification_card">
                        </div>
                        <div class="form-group">
                            <label for="representative_identification_card" class="form-label">Capacidad de modelos</label>
                            <input type="text" class="form-control" id="representative_identification_card">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Imágenes</h4>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo_web" id="logo_web" accept="image/*"
                                   class="load-image filestyle"
                                   data-preview="preview-logo_web" data-btnClass="btn-primary">
                            <div id="preview-logo_web" class="mt-1">
                                <img src="" class="center-block"
                                     style="max-height: 150px; max-width: 100%; background-color: #0a0a0a;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Actualizar</button>
            </div>
        </form>
    </div>
@endsection

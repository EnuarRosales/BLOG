<!-- Modal -->



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carga masiva, archivo Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Recuerda que el sistema necesita obligatoriamente las siguientes columnas <br>
                1. Fecha <br>
                2. CC modelo <br>
                3. Nombre paginas<br>
                4. Cantidad<br>
            </div>

            <div class="modal-footer">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.reportePaginas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="import_file" />

                    <button class="btn btn-primary" type="submit">Importar</button>
                </form>

            </div>
        </div>
    </div>
</div>





<div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-dark">Volver</a>
                </div>
                <div class="card-body">

                    <form wire:submit.prevent="save">
                        <label for="">Titulo del post</label>
                        <input type="text" class="form-control" wire:model='titulo'>
                        <div>
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="">Sistesis del post</label>
                        <textarea type="text" class="form-control mb-3" wire:model='contenido'> </textarea>
                        <div>
                            @error('content')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>

                </div>
            </div>


        </div>
    </div>
</div>

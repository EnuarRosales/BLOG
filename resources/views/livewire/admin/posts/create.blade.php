<div>
    <button type="button" class="btn btn-primary float-right mr-4" data-toggle="modal" data-target="#exampleModal">
        Crear posts
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <label for="">Titulo del post</label>
                    <input type="text" class="form-control" wire:model.defer='titulo'>
                    <div>
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="">Sistesis del post</label>
                    <textarea type="text" class="form-control mb-3" wire:model.defer='contenido'> </textarea>
                    <div>
                        @error('content')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" class="btn btn-primary" wire:click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

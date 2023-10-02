<div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Crear nuevo post</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Sintesis</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody wire:poll>
                            @foreach ($posts as $post )
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->titulo }}</td>
                                <td>{{ $post->contenido }}</td>
                                <td>Acciones</td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
              </div>


        </div>
    </div>
</div>


    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        <br>{{ $error }}        
        @endforeach
    </div>

  
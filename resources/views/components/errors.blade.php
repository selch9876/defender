@if ($errors->any())
    <div class="mb-3 pt-3">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach
    </div>
@endif
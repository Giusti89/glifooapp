<link rel="stylesheet" href="../css/error.css">
<div class="alert alert-danger">
    @if ($errors->any())
        @foreach ($errors->all() as $e)
            <div class="error">
                <h2>{{ $e }}</h2>
            </div>
        @endforeach
    @endif
</div>

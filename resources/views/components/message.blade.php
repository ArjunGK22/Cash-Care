@if (session('message'))
    <div class="alert alert-primary mt-2" role="alert">
        {{ session('message') }}
    </div>
@endif
        
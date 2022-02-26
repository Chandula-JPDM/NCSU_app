@extends('layouts.app')

@section('content')

<div class="container vh-75">
    <main class="container">
        <div class="p-3 pb-1 rounded">
            <h1 class="text-center font-weight-bold">Data Catalogue</h1>
        </div>
    </main>

    <div class="container py-4 px-lg-5">
        <div class="row justify-content-center">
            @foreach($fac as $data)
                <a class="btn btn-outline-primary m-2" href="/catalogue/{{$data->facultyCode}}">{{$data->name}}</a>
            @endforeach
        </div>
    </div>
</div>

@section('footer')
<div class="block mt-auto">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mt-auto">
            <p class="col-md-4 mb-0 text-muted">© 2022 University of Peradeniya</p>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="/forum" class="nav-link px-2 text-muted">Forum</a></li>
                <li class="nav-item"><a href="/catalogue" class="nav-link px-2 text-muted">People</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>

        </footer>
    </div>
</div>
@endsection

@endsection
@extends('layouts.app')

@section('content')

    <div class="container vh-75">
    <main class="container">
    <div class="p-3 pb-1 rounded">
        <h1 class="text-center font-weight-bold">Data Catalogue</h1>
        <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link-light"> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Catalogue</li>
            </ol>
        </nav> -->
    </div>
    </main>
    <div class="container py-4 px-lg-5">
    <div class="row justify-content-center">
        @foreach($fac as $data)
            <a class="btn btn-outline-primary w-25  m-2" href="/catalogue/{{$data->facultyCode}}">{{$data->name}}</a>
        @endforeach
        </div>
    </div>
    </div>
    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"><p class="col-md-6 mb-1 text-muted" style="font-size:80%;">&copy; COPYRIGHT 2022 DEPARTMENT OF COMPUTER ENGINEERING, UOP<br>Last Update : 31/01/2022
        </p>
        <p class="text-xl-left text-muted" style="font-size:80%;"><a href="/documentation/">Documentation</a>
        </p>
    </footer>
    </div>

@endsection
@extends('layouts.app')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/forum.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
@section('content')

<div class="container1">
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
      <img src="/img/back2.jpeg" alt="" srcset="">
        <div class="card-body">
          <h5 class="card-title">Staff</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="/forum/staff" class="btn btn-primary">Form</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
      <img src="/img/back2.jpeg" alt="" srcset="">
        <div class="card-body">          
          <h5 class="card-title">Students</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="/forum/create" class="btn btn-primary">Form</a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('footer')
  <div class="block">
    <div class="container" >
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2022 University of Peradeniya</p>

        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Forum</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">People</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>

      </footer>
    </div>
  </div>
@endsection
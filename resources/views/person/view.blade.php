@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<main class="container">
    <h1>{{$faculty_name}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{request()->route()->batch->batch}}</li>
        </ol>
    </nav>
</main>

<div class="container py-4 px-lg-5">
    <div class="row justify-content-center pb-5">
        @foreach($people as $data)
            <div class="card text-center p-2 m-1 border-primary" style="width: 11rem;">    
                <img src={{$data->image}} style="border-radius: 7%; height:158px;object-fit: cover;" class="card-img-top p-1" alt="">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">
                        {{$data->initial}}
                    </h6>
                    <p class="card-text">{{$data->regNo}}</p>
                    <div class="d-flex flex-row justify-content-center mt-auto">
                        <a class="btn btn-outline-primary w-100" href="/person/{{$data->batch_id}}/{{$data->id}}">View</a>
                    </div>
                </div>
            </div>
        @endforeach    
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container vh-75">
<main class="container">
   <div class="p-3 pb-1 rounded">
       <h1 class="font-weight-bold">{{$facultyname}} | {{$batch}} Batch</h1>
       <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/catalogue">Data Catalogue</a></li>
               <li class="breadcrumb-item"><a href="/catalogue/{{$facultyCode}}">{{$facultyname}}</a></li>
               <li class="breadcrumb-item active" aria-current="page">{{$batch}} Batch</li>
           </ol>
       </nav>
   </div>
</main>
<div class="container py-4 px-lg-5">

    <!-- student cards -->
    
   <div class="row justify-content-center pb-5">
       @foreach($people as $data)
       <div class="card text-center p-2 m-1 border-primary" style="width: 11rem;">
            <img src={{$data->image}} style="border-radius: 7%; height:158px;object-fit: cover;" class="card-img-top p-1" alt="">
           <div class="card-body d-flex flex-column">
               <h6 class="card-title">
                    {{$data->fullname}}
                   </h6>
               <p class="card-text">{{$data->regNo}}</p>
               <div class="d-flex flex-row justify-content-center mt-auto">
                    <a class="btn btn-outline-primary w-100" href="/uop/{{Str::afterLast($data->username,'/')}}">View</a>
               </div>
           </div>
       </div>
       @endforeach
   </div>
    


@section('footer')
<div class="block  mt-auto">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mt-auto">
            <p class="col-md-4 mb-0 text-muted">© 2022 University of Peradeniya</p>

            <ul class="nav col-md-4 justify-content-end">
                <p class="col-md-4 mb-0 text-muted">All rights reserved</p>
            </ul>

        </footer>
    </div>
</div>
@endsection

@endsection
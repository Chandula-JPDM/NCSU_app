@extends('layouts.app')

@section('content')
<div class="container">
<main class="container">
   <div class="p-3 pb-1 rounded">
       @if ($details === null)
        <h1 class="text-center font-weight-bold">Student Not Verified Yet</h1>
       @else
        <h1 class="text-center font-weight-bold">{{$details->fullname}}</h1>
        @endif
       <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/catalogue" >Data Catalogue</a></li>
               <li class="breadcrumb-item" aria-current="page"><a href="/catalogue/{{$facultyCode}}">{{$facultyCode}}</a></li>
               <li class="breadcrumb-item active"><a href="/catalogue/{{$facultyCode}}/{{$batch}}">{{$batch}} Batch</a></li>
           </ol>
       </nav>
   </div>
</main>
  <form class="row g-3 pt-4">

    <div class="mb-3">
      <img src={{$details->image}} style="border-radius: 10%; height:300px; object-fit: cover;" class="rounded mx-auto d-block" alt="">  
    </div>

    <div class="col-md-6">
      <label for="fname" class="form-label">First name</label>

      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->fname}}" disabled>

    </div>
    
    <div class="col-md-6">
      <label for="lname" class="form-label">Last name</label>

      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->lname}}" disabled>

    </div>

    <div class="col-md-6">
      <label for="fullname" class="form-label">Full name</label>

      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->fullname}}" disabled>

    </div>
    
    <div class="col-md-6">
      <label for="initial" class="form-label">Name with initial</label>

      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->initial}}" disabled>

    </div>
    
    <div class="col-md-6">
      <label for="city" class="form-label">City</label>
      
      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->city}}" disabled>
    </div>

    <div class="col-md-6">
      <label for="username" class="form-label">Username</label>
      
      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->username}}" disabled>
    </div>

    <div class="col-12">
      <label for="address" class="form-label">Address</label>
      
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->address}}" disabled>
    </div>

    <div class="col-12">
      <label for="date" class="form-label">Birthday</label>
      
      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->date}}" disabled>

    </div>

    <div class="col-md-6">
      <label for="faculty_id" class="form-label">Facutly name</label>

      <input class="form-control" id="disabledInput" type="text" placeholder="{{$facName}}" disabled>
    </div>

    <div class="col-md-4">
      <label for="department_id" class="form-label">Department name</label>
      <input class="form-control" id="disabledInput" type="text" placeholder="{{$depName}}" disabled>

    </div>

    <div class="col-md-2">
      <label for="regNo" class="form-label">Reg no.</label>
      
      <input class="form-control" id="disabledInput" type="text" placeholder="{{$details->regNo}}" disabled>
    </div>
    <img src="/img/check.svg" alt="verified" width="32" height="32">
    <p class="text-center">Your data is verified by a faculty official on {{$details->updated_at}}</p>

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
@extends('layouts.app')
<head>
  <link rel="stylesheet" href="/css/stafform.css">
</head>

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container p-2 pb-2 rounded">
            <h1 class="text-center font-weight-bold">Staff Data Collection Form</h1>
</div>

<div class="container">
  <form class="row g-3" method="POST" action="/forum" enctype="multipart/form-data">
    @csrf

    <div class="col-md-6">
      <label for="fname" class="form-label">First name</label>

      <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="Alex" name="fname" value="{{ old('fname') }}"  autocomplete="fname" autofocus>

      @error('fname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="lname" class="form-label">Last name</label>

      <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" placeholder="Cooper" name="lname" value="{{ old('lname') }}"  autocomplete="lname" autofocus>

      @error('lname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="fullname" class="form-label">Full name</label>

      <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" placeholder="Alex Steven Cooper" name="fullname" value="{{ old('fullname') }}"  autocomplete="fullname" autofocus>

      @error('fullname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="initial" class="form-label">Name with initial</label>

      <input id="initial" type="text" class="form-control @error('initial') is-invalid @enderror" placeholder="A.S. Cooper" name="initial" value="{{ old('initial') }}"  autocomplete="initial" autofocus>

      @error('initial')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="email" class="form-label">Email</label>
      
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="alex123@xyz.pdn.ac.lk" name="email" value="{{ old('email') }}"  autocomplete="city" autofocus>

      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="username" class="form-label">Username</label>
      
      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Cooper360" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus>

      @error('username')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-12">
      <label for="address" class="form-label">Address</label>
      
      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="1234 Main St, Sanfrancisco, California" name="address" value="{{ old('address') }}"  autocomplete="address" autofocus>

      @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="phone" class="form-label">Contact No.</label>
      
      <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="" name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>

      @error('phone')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="post" class="form-label">Post</label>
      
      <input id="post" type="text" class="form-control @error('post') is-invalid @enderror" placeholder="Senior Lecturer" name="post" value="{{ old('post') }}"  autocomplete="post" autofocus>

      @error('post')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="faculty_id" class="form-label">Facutly name</label>

      <select id="faculty_id" type="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" name="faculty_id" value="{{ old('faculty_id') }}" autocomplete="faculty_id">
        
      </select>

      @error('faculty_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-4">
      <label for="department_id" class="form-label">Department name</label>

      <select id="department_id" type="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id" value="{{ old('department_id') }}" autocomplete="department_id">
        
      </select>

      @error('department_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-6">
      <label for="links" class="form-label">Add Profile links </label>
      <button onclick="addLink()" class="btn btn-primary">Add</button>

      <input id="links" type="text" class="form-control @error('links') is-invalid @enderror" placeholder="" name="links" value="{{ old('links') }}"  autocomplete="links" autofocus>

      @error('links')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    <div class="col-md-6" id="add-field">

    </div>


    <div class="col-12">
      <label for="description" class="form-label">Description</label>
      <textarea id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Please enter bio, educational qualifications, conducted projects and other necessary details" name="description" value="{{ old('description') }}"  autocomplete="address" autofocus></textarea>
    </div>

    <div class="mb-3">
      <label for="formFile" class="form-label">Insert a Profile Image</label>
      <input class="form-control" type="file" id="formFile" name="image" >  
    </div>

    <div class="col-12">
      <p>Above details are true to the best of my knowledge and belief
        and I understand that I subject myself to disciplinary action in the event that
        the above facts are found to be falsified. 
      </p>
      <button type="submit" class="btn btn-primary">Submit</button>
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

@section('script')

<script>
  function addLink() {
    var var1=document.getElementById("add-field");
    var1.innerHTML="<input id='links' type='text' class='form-control @error('links') is-invalid @enderror' placeholder='' name='links' value='{{ old('links') }}'  autocomplete='links' autofocus>"
  }
</script>
@endsection


@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container p-2 pb-2 rounded">
            <h1 class="text-center font-weight-bold">Data Resubmission Form</h1>
</div>
<div class="container">
<form class="row g-3 pt-4" method="POST" action="/forum/resubmission" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="image" class="form-label">Current Photo</label>
      <img src={{$details->image}} style="border-radius: 10%; height:300px; object-fit: cover;" class="rounded mx-auto d-block" alt="">  
    </div>

    <div class="col-md-6">
      <label for="fname" class="form-label">First name</label>

      <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="{{$details->fname}}" name="fname" value="{{$details->fname}}" required autocomplete="fname" autofocus>

      @error('fname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="lname" class="form-label">Last name</label>

      <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" placeholder="{{$details->lname}}" name="lname" value="{{$details->lname}}" required autocomplete="lname" autofocus>

      @error('lname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="fullname" class="form-label">Full name</label>

      <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" placeholder="{{$details->fullname}}" name="fullname" value="{{$details->fullname}}" required autocomplete="fullname" autofocus>

      @error('fullname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="initial" class="form-label">Name with initial</label>

      <input id="initial" type="text" class="form-control @error('initial') is-invalid @enderror" placeholder="{{$details->initial}}" name="initial" value="{{$details->initial}}" required autocomplete="initial" autofocus>

      @error('initial')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>
    
    <div class="col-md-6">
      <label for="city" class="form-label">City</label>
      
      <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="{{$details->city}}" name="city" value="{{$details->city}}" required autocomplete="city" autofocus>

      @error('city')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="username" class="form-label">Username</label>
      
      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{$details->username}}" name="username" value="{{$details->username}}" required autocomplete="username" autofocus>

      @error('username')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-12">
      <label for="address" class="form-label">Address</label>
      
      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="{{$details->address}}" name="address" value="{{$details->address}}" required autocomplete="address" autofocus>

      @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-12">
      <label for="email" class="form-label">Email</label>

      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{$details->email}}" name="email" value="{{$details->email}}" required autocomplete="email" autofocus>

      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="date" class="form-label">Birthday</label>
      
      <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" placeholder="{{$details->date}}" name="date" value="{{$details->date}}" required autocomplete="date" autofocus>

      @error('date')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="batch_id" class="form-label">Batch</label>

      <select id="batch_id" type="batch_id" class="form-select @error('batch_id') is-invalid @enderror" name="batch_id" value="{{ old('batch_id') }}" required autocomplete="batch_id">
        @foreach($batch as $data)
        <option value="{{$data->id}}">{{$data->batch}}</option>
        @endforeach
      </select>

      @error('batch_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="faculty_id" class="form-label">Facutly name</label>

      <select id="faculty_id" type="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" name="faculty_id" value="{{ old('faculty_id') }}" required autocomplete="faculty_id">
        @foreach($fac as $data)
        <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach
      </select>

      @error('faculty_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-4">
      <label for="department_id" class="form-label">Department name</label>

      <select id="department_id" type="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id" value="{{ old('department_id') }}" required autocomplete="department_id">

      </select>

      @error('department_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="regNo" class="form-label">Reg no.</label>
      
      <input id="regNo" type="text" class="form-control @error('regNo') is-invalid @enderror" placeholder="{{$details->regNo}}" name="regNo" value="{{$details->regNo}}" required autocomplete="regNo" autofocus>

      @error('regNo')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="formFile" class="form-label">Insert a Profile Image</label>
      <input class="form-control" type="file" id="formFile" name="image">  
    </div>

    <div class="col-12">
      <p>Above details are true to the best of my knowledge and belief
        and I understand that I subject myself to disciplinary action in the event that
        the above facts are found to be falsified. 
      </p>
      <button type="submit" class="btn btn-primary">Resubmit</button>
    </div>

</form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#faculty_id').on('change', function() {
            let facID = $(this).val();
            if(facID) 
            {
                $.ajax({
                    url: '/forum/create/'+facID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                      // console.log(data);
                      if(data)
                      {
                        $('#department_id').empty();
                        $('#department_id').focus;
                        $('#department_id').append('<option value="">-- Select Department --</option>'); 
                        $.each(data, function(key, value){$('select[name="department_id"]').append('<option value="'+ key +'">' + value.name+ '</option>');});
                      }
                      else
                      {
                        $('#department_id').empty();
                      }
                    }
                });
            }
            else
            {$('#department_id').empty();}
        });
    });
</script>
@endsection
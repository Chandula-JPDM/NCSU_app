@extends('layouts.app')
<head>
  <link rel="stylesheet" href="/css/stafform.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
  <form class="row g-3" method="POST" action="/forum/staff" enctype="multipart/form-data">
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

    <div class="col-md-6">
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
      <label for="website" class="form-label">Links</label>      
      <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" placeholder="Website URL" name="website" value="{{ old('website') }}"  autocomplete="website" autofocus>
  
      @error('website')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <label for="website" class="form-label" style="color:white;">Links</label>  
      <input id="likdin" type="text" class="form-control @error('linkdin') is-invalid @enderror" placeholder="Linkdin URL" name="linkdin" value="{{ old('linkdin') }}"  autocomplete="linkdin" autofocus>
      
      @error('linkdin')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <input id="gscholar" type="text" class="form-control @error('gscholar') is-invalid @enderror" placeholder="Google Scholar URL" name="gscholar" value="{{ old('gscholar') }}"  autocomplete="gscholar" autofocus>
      
      @error('gscholar')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input id="rgate" type="text" class="form-control @error('rgate') is-invalid @enderror" placeholder="Researchgate URL" name="rgate" value="{{ old('rgate') }}"  autocomplete="rgate" autofocus>
      
      @error('rgate')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

    </div>

    <div class="col-md-6">
      <input id="orcid" type="text" class="form-control @error('orcid') is-invalid @enderror" placeholder="Orcid URL" name="orcid" value="{{ old('orcid') }}"  autocomplete="orcid" autofocus>
      
      @error('orcid')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-md-6">
      <input id="sindex" type="text" class="form-control @error('sindex') is-invalid @enderror" placeholder="Scientific index URL" name="sindex" value="{{ old('sindex') }}"  autocomplete="sindex" autofocus>
      
      @error('sindex')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="col-12">
      <label for="editor" class="form-label">Description</label>
      <textarea id="editor" type="text" class="form-control @error('editor') is-invalid @enderror" placeholder="enter bio, educational qualifications, conducted rojects and other necessary details" name="editor" value="{{ old('editor') }}"  autocomplete="editor" autofocus></textarea>
      @error('editor')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
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
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<script>
  $('.add').on('click', add);
  $('.remove').on('click', remove);

  function add() {
  var new_chq_no = parseInt($('#total_chq').val()) + 1;
  var new_input = "<input type='text' id='new_" + new_chq_no + "'>";
  $('#addlink').append(new_input);
  }
  
  function remove() {
    var last_chq_no = $('#total_chq').val();
    if (last_chq_no > 1) {
      $('#new_' + last_chq_no).append('');
      $('#total_chq').val(last_chq_no - 1);
    }
  }
</script>
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

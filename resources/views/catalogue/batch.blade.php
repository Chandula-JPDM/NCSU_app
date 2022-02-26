@extends('layouts.app')

@section('content')

    <div class="container vh-75">
    <main class="container">
    <div class="p-3 pb-1 rounded">
        <h1 class="font-weight-bold">{{$facultyname}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/catalogue">Data Catalogue</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$facultyname}}</li>
            </ol>
        </nav>
    </div>
    </main>
   <div class="container">
       <div class="row">
           <div class="list-group col-lg-10 col p-2 mx-auto">
               <div id="results-container">
               </div>
           </div>
       </div>
       <div id="main-container" class="container pt-2 px-5">
           <div class="row justify-content-center">
               
               <!-- Academic Staff cards -->
               <div class="card text-center p-2 cardSpacingHome border-primary" style="width:18rem;">
                   <div class="card-header">
                       <h5>Academic Staff</h5>
                   </div>
                    {{-- <img src="/images/homepage/staff.jpg" class="card-img-top p-3" alt="Staff"> --}}
                   <div class="card-body">
                       <ul class="list-group list-group-flush">
                            <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/staff/academic/">Academic Staff</a>
                            <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/staff/temporary-academic-staff/">Temporary Academic
                                Staff</a>
                            <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/staff/academic-support-staff/">Visiting 
                                Staff</a>
                            <br>
                       </ul>
                   </div>
               </div>

               <!-- Non Acaademic Staff cards -->
               <div class="card text-center p-2 cardSpacingHome border-primary" style="width:18rem;">
                   <div class="card-header">
                       <h5>Non Academic Staff</h5>
                   </div>
                    {{-- <img src="/images/homepage/staff.jpg" class="card-img-top p-3" alt="Staff"> --}}
                   <div class="card-body">
                       <ul class="list-group list-group-flush">
                            <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/staff/academic/">Permanent Staff</a>
                            <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/staff/temporary-academic-staff/">Temporary/Trainee/Contract
                                Staff</a>
                            <br>
                       </ul>
                   </div>
               </div>

               <!-- Student cards -->
               <div class="card text-center p-2 cardSpacingHome border-primary" style="width:18rem;">
                   <div class="card-header">
                       <h5>Students</h5>
                   </div>
                    {{-- <img src="/images/homepage/student.jpg" class="card-img-top p-3" alt="Students"> --}}
                   <div class="card-body">
                       @foreach($batches as $data)
                        <a class="btn btn-outline-primary w-100 buttonBottomMargin" href="/catalogue/{{$facultyCode}}/{{$data->id}}">{{$data->id}} Batch</a>
                       @endforeach
                    </div>
               </div>
           </div>
       </div>
   </div>
    <script src="/assets/js/search-script.js" type="text/javascript"></script>
    <script>
        //prevent submit by pressing enter
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        SimpleJekyllSearch({
            searchInput: document.getElementById('search-input'),
            resultsContainer: document.getElementById('results-container'),
            json: '/search/search.json'
                            })
    </script>
</div>
   </div>

@section('footer')
<div class="block mt-auto">
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
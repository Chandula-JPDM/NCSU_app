@extends('layouts.app')

@section('charts')
    <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div> 
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('s_admin_chart')",
        hooks: new ChartisanHooks()
                .colors(['#8A0008'])
                .title('No of Unverified Students Vs Faculty Code', { position: 'center' }),
      });
    </script>
@endsection

@section('content')
<div class="container">
    @if ($user->is_admin === 1)

        @section('navbar')
        <a class="dropdown-item" href="/profile/create">Add new user</a>
        <a class="dropdown-item" href="/faculty/create">Add new faculty</a>
        @endsection

        <div class ="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Faculty</th>
                    <th scope="col">Active</th>
                    <th scope="col">Type(Admin/user)</th>
                    <th scope="col">Last Login</th>
                    <th scope="col">Remark</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($name as $data)
                    @if($data->is_admin === 1)
                        @php $isAdmin = "Super admin"; @endphp
                    @elseif($data->is_admin === 0)
                        @php $isAdmin = "admin"; @endphp
                    @endif

                    @if($data->active === 1)
                        @php $active = "Yes"; @endphp
                    @elseif($data->active === 0)
                        @php $active = "No"; @endphp
                    @endif

                    <tr>
                        <th scope="row">{{$data->id}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->username}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->faculty->name}}</td>
                        <td>{{$active}}</td>
                        <td>{{$isAdmin}}</td>
                        <td>{{$data->lastOnline}}</td>
                        <td>{{$data->remark}}</td>
                        <td><a type="button" class="btn btn-primary btn-sm" role="button" href="/profile/{{$data->id}}">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div> -->
        <main class="container">
            <h1>Admin | {{$user->faculty->name}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </main>
        
        <div class="row justify-content-center pb-5">
                @foreach($batch as $data)
                <div class="card text-center p-2 m-1 border-primary" style="width: 11rem;">
                <div class="card-body d-flex flex-column">
                <h6 class="card-title">
                    {{$people[$data->id]}}
                    </h6>
                <p class="card-text">To be verified..</p>
                <div class="d-flex flex-row justify-content-center mt-auto">
                        <a role="button" class="btn btn-outline-primary" type="button" href="/person/{{$data->id}}">{{$data->batch}}</a>
                </div>
                </div>
                </div>
                @endforeach
    @endif
</div>

@endsection

@section('footer')
<div class="block mt-auto">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2022 University of Peradeniya</p>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="/forum/create" class="nav-link px-2 text-muted">Forum</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">People</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>

        </footer>
    </div>
</div>
@endsection
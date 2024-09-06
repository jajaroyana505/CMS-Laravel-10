@extends('back.layout.template')
@section('title', 'Users Detail - Admin')

@section('content')

<!-- content -->

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">User</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>

            </ul>
        </div>
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('users')}}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email Address</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email')}}">
                            </div>
                            <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="username" name="username" value="{{old('username')}}">
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="mb-2 mt-4">
                                <button class="btn btn-primary float-end" type="submit">Create</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@push('js')



@endpush

@endsection
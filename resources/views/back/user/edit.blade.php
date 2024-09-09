@extends('back.layout.template')
@section('title', 'Users Edit - Admin')

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
                    <a href="#">Edit</a>
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
                    <div class="card-header">
                        <h3>Edit Data User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users/'. $user->id)}}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{$user->name}}">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email Address</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}">
                                <input type="hidden" name="oldEmail" value="{{ $user->email }}">
                            </div>
                            <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}">
                            </div>

                            <div class="mb-2 mt-3">
                                <label for="" class="form-label">Select Roles :</label>
                                <div class="form-check d-flex">
                                    <?php
                                    // dd($userRole);
                                    // die;
                                    ?>
                                    @foreach ($roles as $role)
                                    {{$user->Role}}
                                    <div class="">
                                        <input class="form-check-input" {{ in_array($role->name, $userRole->toArray()) ? 'checked' : ''; }} name="roles[]" type="checkbox" value="{{$role->name}}" id="{{$role->name}}">
                                        <label class="form-check-label" for="{{$role->name}}">
                                            {{ $role->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <small>*Select one or more roles</small>
                            </div>

                            <div class="mb-2 mt-4">
                                <button class="btn btn-primary float-end" type="submit">Save</button>
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
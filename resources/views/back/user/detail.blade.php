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
                    <a href="#">Detail</a>
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

            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-header" style="background-image: url('http://127.0.0.1:8000/assets/img/blogpost.jpg')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xxl">
                                <img src="{{asset('/')}}assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name">{{ $user->name }}</div>
                            <div class="job">Frontend Developer</div>
                            <div class="desc">A man who hates loneliness</div>
                            <div class="social-media">
                                <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                    <span class="btn-label just-icon"><i class="icon-social-twitter"></i>
                                    </span>
                                </a>
                                <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="icon-social-facebook"></i>
                                    </span>
                                </a>
                                <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="icon-social-instagram"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="view-profile">
                                <a href="#" class="btn btn-secondary w-100">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row user-stats text-center">
                            <div class="col">
                                <div class="number">125</div>
                                <div class="title">Post</div>
                            </div>
                            <div class="col">
                                <div class="number">25K</div>
                                <div class="title">Followers</div>
                            </div>
                            <div class="col">
                                <div class="number">134</div>
                                <div class="title">Following</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@push('js')



@endpush

@endsection
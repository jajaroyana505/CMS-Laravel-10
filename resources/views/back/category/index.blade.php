@extends('back.layout.template')
@section('title', 'List Categories - Admin')

@section('content')

<!-- content -->

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Category</a>
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

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Category List</h3>
                        <div class="mb-3">
                            <button class="btn btn-rounded btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                                <i class="fas fa-plus me-2"></i>
                                Add Category
                            </button>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="data-category">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Sluge</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $category->name}}</td>
                                <td>{{ $category->slug}}</td>
                                <td>{{ $category->created_at}}</td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $category->id}}">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $category->id}}">Delete</button>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>



        </div>
    </div>
</div>

@include('back.category.create-modal')
@include('back.category.update-modal')
@include('back.category.delete-modal')


@push('js')
<script src="{{asset('/')}}assets/js/plugin/datatables/datatables.min.js"></script>


<script>
    $("#data-category").DataTable()
</script>

@endpush

@endsection
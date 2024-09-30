@extends('back.layout.template')
@section('title', "{{$page}} - Admin")

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
                    <a href="#">{{$page}}</a>
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

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Vendor List</h3>
                        <div class="mb-3">
                            <a href="{{ url('users/create')}}" class="btn btn-rounded btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Add Vendor
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="data-vendor">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')
<script src="{{asset('/')}}assets/js/plugin/datatables/datatables.min.js"></script>
<script>
    $('#data-vendor').DataTable({
        processing: true,
        serverside: true,
        ajax: "{{ url()->current() }}",
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "open_hours",
                name: "open_hours",
            },
            {
                data: "closing_hours",
                name: "closing_hours",
            },
            {
                data: "button",
                name: "button",
            },
        ]
    })
    $(document).ready(function() {
        // new DataTable('#data-article');

    })
</script>

@endpush
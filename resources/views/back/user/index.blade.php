@extends('back.layout.template')
@section('title', 'Users List - Admin')

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
                        <h3>User List</h3>
                        <div class="mb-3">
                            <a href="{{ url('users/create')}}" class="btn btn-rounded btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Add User
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="data-user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>


@push('js')
<script src="{{asset('/')}}assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // const data = $('.swal').data('swal')
    const data = $('.notif').data('notif')

    if (data) {
        var placementFrom = "top";
        var placementAlign = "center";
        var state = "success";
        var style = "withicon";
        var content = {};

        content.message = data;
        content.title = state;
        if (style == "withicon") {
            content.icon = "fa fa-bell";
        } else {
            content.icon = "none";
        }
        // content.url = "index.html";
        // content.target = "_blank";

        $.notify(content, {
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign,
            },
            // time: 1000,
            // showProgressbar: true,
            progress: 10,
            // delay: 0,
        });

    }




    function deleteUser(e) {
        let id = e.getAttribute('data-id')
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: "/users/" + id,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            window.location.href = '/users'
                        })
                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + "\n" + xhr.response + "\n" + throwError)
                    }

                });

            }
        });

    }
</script>
<script>
    // $("#data-user").DataTable()
</script>
<script>
    $('#data-user').DataTable({
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
                data: "email",
                name: "email",
            },
            {
                data: "role",
                name: "role",
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

@endsection
@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'List Aricles - Admin')

@section('content')

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
                    <a href="#">Article</a>
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

            <div class="notif" data-notif=" {{ session('success')}}"></div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Article List</h3>
                        <div class="mb-3">
                            <a href="{{ url('articles/create')}}" class="btn btn-round btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Create Article
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="data-article">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Publish Date</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <div class="mt-3">
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
@include('back.article.add-category-modal')

@push('js')


<script src="{{asset('/')}}assets/js/plugin/datatables/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- Sweet Alert -->
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




    function deleteArticle(e) {
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
                    url: "/articles/" + id,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            window.location.href = '/articles'
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
    $('#data-article').DataTable({
        processing: true,
        serverside: true,
        ajax: "{{ url()->current() }}",
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "title",
                name: "title",
            },
            {
                data: "category_id",
                name: "category_id",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "views",
                name: "views",
            },

            {
                data: "publish_date",
                name: "publish_date",
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
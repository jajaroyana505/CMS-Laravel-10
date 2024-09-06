@extends('back.layout.template')



@section('title', 'Detail Aricles - Admin')
@section('content')

<!-- content -->






<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-2">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Articel</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail Article</a>
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


            <div class="row">

                <div class="col-md-9 mb-3 card">
                    <div class="card-body">
                        {!!$article->body!!}
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <p class="fw-bold">
                                    {{$article->title}}
                                </p>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <p class="fw-bold">
                                    {{$article->Category->name}}
                                </p>

                            </div>
                            <div class=" mb-3">
                                <label for="img" class="form-label">Image</label><br>
                                <img width="250" src="{{asset('storage/back/'. $article->img)}}" alt="" class="img-thumbnail">
                            </div>
                            <div class=" mb-3">
                                <label for="publish_date" class="form-label">Publish Date</label>
                                <p class="fw-bold">
                                    {{$article->publish_date}}
                                </p>
                            </div>

                            <div class=" mb-3">
                                <label for="status" class="form-label">Satatus</label>

                                @if ($article->status != '0')
                                <span class='badge bg-success'>Publish</span>
                                @else
                                <span class='badge bg-danger'>Private</span>
                                @endif

                            </div>
                            <label class="form-label">Tag</label>
                            <div>
                                <span id="label-tag" data-tags="{{$article->tag}}"></span>
                            </div>
                            <div class="mt-3">
                                <a href="{{url('articles/'. $article->id.'/edit')}}" type="submit" class="btn btn-sm btn-primary float-end">Edit</a>
                                <a href="{{url('articles/')}}" type="submit" class="btn btn-sm btn-secondary float-end me-2">Back</a>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </div>
</div>






@push("js")
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    // CKEDITOR.replace('myeditor', options);
</script>

<script>
    let labelTag = $("#label-tag")
    var tags = labelTag.data('tags').split(',');


    for (let index = 0; index < tags.length; index++) {
        if (tags[index] != ' ') {
            labelTag.append("<p class='badge text-dark bg-light me-1'>" + tags[index] + "</p>")
        }
    }
</script>

@endpush

@endsection
@extends('back.layout.template')



@section('title', 'Edit Aricles - Admin')
@section('content')

<!-- content -->
<script src="https://cdn.tiny.cloud/1/esp5nak44mw1286yjomaujlbolc9f5y9ao466pfrcb6v3ua7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>






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
                    <a href="#">Edit Article</a>
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

            <form action="/articles/{{ $article->id}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-9 mb-3">
                        <textarea class="form-control" name="body" id="article-editor" style="min-height: 70vh;">
                        {{$article->body}}

                        </textarea>
                    </div>
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input id="title" name="title" type="text" class="form-control" value="{{ $article->title}}">
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="category_id" id="category">
                                        <option value="" hidden>--choose--</option>
                                        @foreach ($categories as $category)
                                        @if ($category->id == $article->Category->id)
                                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                                        @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input type="file" name="img" id="img" class="form-control">
                                    <input name="old_img" type="hidden" value="{{ $article->img}}">

                                    <small>Old image</small><br>

                                    <img width="250" src="{{asset('storage/back/'. $article->img)}}" alt="" class="img-thumbnail">
                                </div>
                                <div class=" mb-3">
                                    <label for="publish_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" name="publish_date" value="{{ $article->publish_date}}">
                                </div>

                                <div class=" mb-3">
                                    <label for="status" class="form-label">Satatus</label>
                                    <select class="form-select" name="status" id="status">
                                        <option {{ $article->status== 1 ? 'selected':'';}} value="1">Publish</option>
                                        <option {{ $article->status== 0 ? 'selected':'';}} value="0">Private</option>
                                    </select>
                                    {{ $article->status== 1 ? 'selected':'';}}
                                </div>
                                <div class=" mb-3">
                                    <label for="tag" class="form-label">Tag</label>
                                    <div>
                                        <span id="label-tag"></span>
                                    </div>
                                    <textarea class="form-control" name="tag" id="tag">{{ $article->tag }}</textarea>
                                </div>

                                <div class="">
                                    <button type="submit" class="btn btn-primary float-end">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    tinymce.init({
        selector: '#article-editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>

<script>
    // Tag article
    let tag = $("#tag")
    let labelTag = $("#label-tag")
    tag.change(function() {
        // console.log(tag.val())
        var segmen = tag.val().split(',');
        labelTag.html('')
        for (let index = 0; index < segmen.length; index++) {
            if (segmen[index] != ' ') {
                labelTag.append("<p class='badge text-dark bg-light me-1'>" + segmen[index] + "</p>")
            }
        }

    })
    if (tag.val() != '') {
        var segmen = tag.val().split(',');
        labelTag.html('')
        for (let index = 0; index < segmen.length; index++) {
            if (segmen[index] != ' ') {
                labelTag.append("<p class='badge text-dark bg-light me-1'>" + segmen[index] + "</p>")
            }
        }
    }
</script>
@endpush

@endsection
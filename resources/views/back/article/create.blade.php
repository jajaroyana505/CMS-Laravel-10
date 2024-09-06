@extends('back.layout.template')



@section('title', 'Create Aricles - Admin')
@section('content')

<!-- content -->

<!-- Tiny MCE7 -->
<script src="https://cdn.tiny.cloud/1/esp5nak44mw1286yjomaujlbolc9f5y9ao466pfrcb6v3ua7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Tiny MCE5 -->
<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

<!-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Article</h1>
    </div>



</main> -->

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
                    <a href="#">Create Article</a>
                </li>
            </ul>
        </div>
        <div class="row">
            @error('body')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror


            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif

            <form action="/articles" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9 mb-3">
                        <textarea class="form-control " name="body" id="article-editor" style="min-height: 70vh;">{{old('body')}}</textarea>
                        @error('body')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title Article</label>
                                    <input id="title" name="title" type="text" class="form-control {{ $errors->has('title')? 'is-invalid':'';}}" value="{{old('title')}}">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label d-flex">Category

                                    </label>

                                    <select class="form-control {{ $errors->has('category_id')? 'is-invalid':'';}}" name="category_id" id="category">
                                        <option value="" hidden>--choose--</option>
                                        </option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <span class="btn nav-link" data-bs-toggle="modal" data-bs-target="#add-category">
                                        <i class="fas fa-plus me-2"></i>
                                        Add Category
                                    </span> -->
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" mb-3">
                                    <label for="img" class="form-label">Image (max 2MB)</label>
                                    <input type="file" name="img" id="img" class="form-control {{ $errors->has('img')? 'is-invalid':'';}}">
                                    @error('img')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" mb-3">
                                    <label for="publish_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control {{ $errors->has('publish_date')? 'is-invalid':'';}}" name="publish_date">
                                    @error('publish_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" mb-3">
                                    <label for="status" class="form-label">Satatus</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="1">Publish</option>
                                        <option value="0">Private</option>
                                    </select>
                                </div>
                                <div class=" mb-3">
                                    <label for="tag" class="form-label">Tag</label>
                                    <div>
                                        <span id="label-tag"></span>
                                    </div>
                                    <textarea class="form-control" name="tag" id="tag">{{old('tag')}}</textarea>
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


@include('back.article.add-category-modal')



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
    // tinymce.init({
    //     selector: '#article-editor',
    //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

    // });
</script>
<script>
    // var editor_config = {
    //     path_absolute: "{{url('/')}}",
    //     selector: '#article-editor',
    //     relative_urls: false,
    //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //     file_picker_callback: function(callback, value, meta) {
    //         var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    //         var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

    //         var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
    //         if (meta.filetype == 'image') {
    //             cmsURL = cmsURL + "&type=Images";
    //         } else {
    //             cmsURL = cmsURL + "&type=Files";
    //         }

    //         tinyMCE.activeEditor.windowManager.openUrl({
    //             url: cmsURL,
    //             title: 'Filemanager',
    //             width: x * 0.8,
    //             height: y * 0.8,
    //             resizable: "yes",
    //             close_previous: "no",
    //             onMessage: (api, message) => {
    //                 callback(message.content);
    //             }
    //         });
    //     }
    // };
    var editor_config = {
        path_absolute: "{{ url('/') }}/",
        selector: '#article-editor',
        relative_urls: false,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback: function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype === 'image') {
                cmsURL += "&type=Images";
            } else {
                cmsURL += "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: true,
                close_previous: false,
                onMessage: function(api, message) {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);
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
                labelTag.append("<p class='badge text-dark bg-light'>" + segmen[index] + "</p>")
            }
        }

    })
    if (tag.val() != '') {
        var segmen = tag.val().split(',');
        labelTag.html('')
        for (let index = 0; index < segmen.length; index++) {
            if (segmen[index] != ' ') {
                labelTag.append("<p class='badge text-dark bg-light'>" + segmen[index] + "</p>")
            }
        }
    }
</script>



@endpush

@endsection
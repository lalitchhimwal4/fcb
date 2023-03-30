@section('title','Edit News,Publications')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Edit News,Publications</h1>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
            <form id="newspublicationsform" action="{{route('admin.UpdateNewsPublications',$news_publication->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="Type">Type</label>
                        <select id="Type" name="Type" class="@error('Title') is-invalid @enderror form-control">
                            <option value="1" {{($news_publication->type==1)?'selected':''}}>News</option>
                            <option value="2" {{($news_publication->type==2)?'selected':''}}>Publication</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" id="Title" name="title" class="@error('Title') is-invalid @enderror form-control" placeholder="Enter Title" value="{{$news_publication->title}}">
                    </div>
                    <div class="form-group">
                        <label for="Short_Description">Short Description</label>
                        <textarea id="Short_Description" name="Short_Description" class="@error('Short_Description') is-invalid @enderror form-control" placeholder="Enter Short Description"> {{$news_publication->short_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for=" Full_Description"> Full Description</label>
                        <textarea id="Full_Description" name="Full_Description" class="@error('Full_Description') is-invalid @enderror form-control" placeholder="Enter Full Description">{{$news_publication->full_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="Published">Published</label>
                        <input type="text" id="Published" name="published" class="@error('Published') is-invalid @enderror form-control" placeholder="Enter Published in" value="{{$news_publication->published}}">
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select id="Status" name="Status" class="@error('Status') is-invalid @enderror form-control">
                            <option value="1" {{($news_publication->status==1)?'selected':'' }}>Active</option>
                            <option value="0" {{($news_publication->status==0)?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerjs')
<script>

    //frontend validation start
    $(document).ready(function() {
        if ($("#newspublicationsform").length > 0) {
            $("#newspublicationsform").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                        minlength: 3,
                    },
                    Type: {
                        required: true,
                    },
                    Short_Description: {
                        required: true,
                    },
                    Full_Description: {
                        required: function(textarea) {
                            CKEDITOR.instances[textarea.id].updateElement();
                            var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                            return editorcontent.length === 0;
                        },
                    },
                    Status: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please enter Title",
                    },
                    Type: {
                        required: "Please select Type",
                    },
                    Short_Description: {
                        required: "Please enter short description",
                    },
                    Full_Description: {
                        required: "Please enter full description",
                    },
                    Status: {
                        required: "Please select Status",
                    },
                },
            })
        }
        //frontend validation complete

        //ckeditor
        ckeditor('Full_Description', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");
    })
</script>
@endsection
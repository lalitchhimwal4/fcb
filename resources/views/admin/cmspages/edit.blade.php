@section('title','Admin-Profile')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Edit Cms Page</h1>
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
            <form id="cmspageform" action="{{route('admin.UpdateCmsPage',$cmspage->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body card-body-wrapper">
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" id="Title" name="Title" class="@error('Title') is-invalid @enderror form-control" placeholder="Enter Title" value="{{$cmspage->title}}">
                    </div>
                    <button class="btn btn-success" type="button" id="addsubtitle">Add Subtitle</button>
                    <div class="form-group" id="subtitle">
                        <label for="Title">Sub Title</label>
                        <input type="text" id="Subtitle" name="Subtitle" class="@error('Subtitle') is-invalid @enderror form-control" placeholder="Enter Sub Title" value="{{$cmspage->subtitle}}">
                    </div>
                    <button class="btn btn-danger" type="button" id="removesubtitle">Remove Subtitle</button>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea id="Description" name="Description" class="@error('Description') is-invalid @enderror form-control" placeholder="Enter Description"> {{$cmspage->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="MetaTitle">Meta Title</label>
                        <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{$cmspage->meta_title}}">
                    </div>
                    <div class="form-group">
                        <label for="MetaKeyword">Meta Keyword</label>
                        <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{$cmspage->meta_keyword}}">
                    </div>
                    <div class="form-group">
                        <label for="MetaDescription">Meta Description</label>
                        <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{$cmspage->meta_description}}">
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select id="Status" name="Status" class="@error('Status') is-invalid @enderror form-control">
                            <option value="1" {{($cmspage->status==1)?'selected':'' }}>Active</option>
                            <option value="0" {{($cmspage->status==0)?'selected':'' }}>Inactive</option>
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
        if ($("#cmspageform").length > 0) {
            $("#cmspageform").validate({
                rules: {
                    Title: {
                        required: true,
                        maxlength: 50,
                        minlength: 3,
                    },
                    Status: {
                        required: true,
                    },
                },
                messages: {
                    Title: {
                        required: "Please enter Title",
                    },
                    Status: {
                        required: "Please select Status",
                    },
                },
            })
        }
        //frontend validation complete

        //ckeditor function is defined in common.js
        ckeditor('Description', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");

        //Subtitle field toggling
        <?php
        if (empty($cmspage->subtitle)) {
            ?>
            $('#subtitle').hide();
            $('#removesubtitle').hide();

            $('#addsubtitle').click(function() {
                $('#subtitle').show();
                $('#removesubtitle').show();
                $('#addsubtitle').hide();
            });

            $('#removesubtitle').click(function() {
                $('#subtitle').hide();
                $('#Subtitle').val("");
                $('#removesubtitle').hide();
                $('#addsubtitle').show();
            });
            <?php
        } else {
            ?>
            $('#addsubtitle').hide();

            $('#addsubtitle').click(function() {
                $('#subtitle').show();
                $('#removesubtitle').show();
                $('#addsubtitle').hide();
            });

            $('#removesubtitle').click(function() {
                $('#subtitle').hide();
                $('#Subtitle').val("");
                $('#removesubtitle').hide();
                $('#addsubtitle').show();
            });
            <?php
        }
        ?>
    })
</script>
@endsection
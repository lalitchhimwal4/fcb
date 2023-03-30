@section('title','Add Accordian')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Add Accordian</h1>
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
            <form id="AddAccordianForm" action="{{route('admin.SaveAccordian')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-wrap">
                        <h4>Accordian</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Page_Title">Page Title</label>
                                <select id="Page_Title" name="Page_Title" class="@error('Page_Title') is-invalid @enderror form-control" placeholder="Enter Page Title" value="">
                                    <option value="homepage">Homepage</option>
                                    <option value="payors">Agent Brokers - Payors</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror form-control" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea id="Description" name="Description" class="@error('Description') is-invalid @enderror form-control" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select id="Status" name="Status" class="@error('Status') is-invalid @enderror form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
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
    $(document).ready(function() {

        //frontend validation start
        if ($("#AddAccordianForm").length > 0) {
            $("#AddAccordianForm").validate({
                ignore: [],
                rules: {
                    Page_Title: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    Description: {
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
                    Page_Title: {
                        required: "Please select page title",
                    },
                    title: {
                        required: "Please enter title",
                    },
                    Description: {
                        required: "Please enter description",
                    },
                    Status: {
                        required: "Please select status",
                    },
                },
            })
        }
        //frontend validation complete

        //ckeditor
        ckeditor('Description', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");
    })
</script>
@endsection
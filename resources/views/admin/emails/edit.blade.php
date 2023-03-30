@section('title','Email Template')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Email Template</h1>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="">
            @include('admin.error_message')
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
            <form role="form" method="post" action="{{ route('admin.emails.update', $email->slug) }}" id="businessSubForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group label-floating is-focused">
                    <label class="control-label">Subject*</label>
                    <input type="text" class="form-control " name="subject" value="{{$email->subject}}" id="subject1">
                </div>
                <div class="form-group">
                    <label for="body">Body*</label>
                    <textarea id="body" name="body" class="@error('body') is-invalid @enderror form-control">{{$email->body}}</textarea>
                </div>
                <div class="card-footer">
                    <button type="submit" id="businessSubFormBtn" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerjs')
<script type="text/javascript">
    //ckeditor
    ckeditor('body', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");
</script>
@endsection
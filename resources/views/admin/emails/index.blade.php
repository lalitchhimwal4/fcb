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
            <form class="row email-temp-row" method="post">
                @csrf
                <div class="col-md-3"><label class="control-label">Enter Email Template Title</label></div>
                <div class="col-md-4"><input type="text" name="title" class="form-control" required></div>
                <div class="col-md-2"><button class="btn btn-primary">Submit</button></div>
            </form>
            <div class="card-body table-responsive">
                <table id="customboxeslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Template ID</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emails as $email)
                        <tr>
                            <td>{{$email->id}}</td>
                            <td>{{$email->title}}</td>
                            <td>
                                <a href="{{url(route('admin.emails.update',$email->slug))}}" class="btn btn-danger">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
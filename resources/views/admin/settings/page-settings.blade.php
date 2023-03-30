@section('title','Page Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Page Settings</h1>
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
            <div class="card-body table-responsive">
                <table id="pageslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Banners</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','banner-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Homepage</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','homepage-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Payors - Agents Brokers</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','agents-brokers-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>News</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','news-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Publications</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','publications-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Prescriptions</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','prescriptions-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Vision</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','vision-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Contact Us</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','contact-us-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Providers</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','providers-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Plan Members</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','plan-members-settings')}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td>Services</td>
                            <td> <a class="btn btn-primary" href="{{route('admin.Settings','services-settings')}}">Edit</a></td>
                        </tr>
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
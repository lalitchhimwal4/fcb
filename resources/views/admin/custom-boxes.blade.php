@section('title','Custom Boxes Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Custom box Settings</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
            <form id="CustomBoxesForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="CustomBoxes" name="Settings_Type">
                <div class="card-body">
                    <div class="form-wrap">
                        <h4>Custom Box</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" id="Title" name="Title" class="@error('Title') is-invalid @enderror form-control" placeholder="Enter Title" value="">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea id="Description" name="Description" class="@error('Description') is-invalid @enderror form-control" placeholder="Enter Description"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="Image">Image</label>
                                <input type="file" id="Image" name="Image" class="@error('Image') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Button_Text">Button Text</label>
                                <input type="text" id="Button_Text" name="Button_Text" class="@error('Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="">
                            </div>
                            <div class="form-group">
                                <label for="Button_Link">Button Link</label>
                                <input type="text" id="Button_Link" name="Button_Link" class="@error('Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="">
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
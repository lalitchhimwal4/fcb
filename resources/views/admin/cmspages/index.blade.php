@section('title','Cms Pages')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Cms Pages</h1>
    </div>
    <!-- /.content-header -->
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
    <a href="{{route('admin.AddCmsPage')}}" class="btn btn-primary">Add Cms Page</a>
    <div class="card-body card-body-wrapper table-responsive">
        <table id="cmspageslist" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($cmspages as $cmspage)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$cmspage->title}}</td>
                    <td>{{$cmspage->slug}}</td>
                    <td><?php echo ($cmspage->status == 1) ? 'Active' : 'Inactive'; ?></td>
                    <td> <a class="btn btn-primary" href="{{route('admin.EditCmsPage',$cmspage->id)}}">Edit</a> <a class="btn btn-primary" onclick="return confirm('It will delete permanenlty {{$cmspage->title}} page')" href="{{route('admin.DeleteCmsPage',$cmspage->id)}}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
@section('title','Custom Boxes Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Custom boxes</h1>
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
            <a href="{{route('admin.AddCustomBox')}}" class="btn btn-primary">Add Custom Box</a>
            <div class="card-body table-responsive">
                <table id="customboxeslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Title</th>
                            <th>Page</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($customboxes as $custombox)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$custombox->title}}</td>
                            <td>{{$custombox->type}}</td>
                            <td><?php echo ($custombox->status == 1) ? 'Active' : 'Inactive'; ?></td>
                            <td> <a class="btn btn-primary" href="{{route('admin.EditCustomBox',$custombox->id)}}">Edit</a> <a class="btn btn-primary" onclick="return confirm('It will delete permanenlty {{$custombox->title}} ')" href="{{route('admin.DeleteCustomBox',$custombox->id)}}">Delete</a></td>
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
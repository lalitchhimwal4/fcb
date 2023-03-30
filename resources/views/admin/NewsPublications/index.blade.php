@section('title','News and Publications')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">News and Publications</h1>
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
    <a href="{{route('admin.AddNewsPublications')}}" class="btn btn-primary">Add New </a>
    <div class="card-body card-body-wrapper table-responsive">
        <table id="cmspageslist" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Type</th>
                    <th>Published</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($news_publications as $news_publication)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$news_publication->title}}</td>
                    <td>{{$news_publication->slug}}</td>
                    <td><?php echo ($news_publication->type == 1) ? 'News' : 'Publication'; ?></td>
                    <td>{{$news_publication->published}}</td>
                    <td><?php echo ($news_publication->status == 1) ? 'Active' : 'Inactive'; ?></td>
                    <td> <a class="btn btn-primary" href="{{route('admin.EditNewsPublications',$news_publication->id)}}">Edit</a> <a class="btn btn-primary" onclick="return confirm('It will delete permanenlty {{$news_publication->title}} ')" href="{{route('admin.DeleteNewsPublications',$news_publication->id)}}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
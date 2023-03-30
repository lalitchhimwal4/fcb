@section('title','Admin-Profile')
@extends('layouts.admin.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profile</h1>
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


      <form id="adminprofile" action="{{route('admin.saveprofile')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" id="Name" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter Name" value="{{$user->name}}">
          </div>
          <div class="form-group">
            <label for="Email">Email address</label>
            <input type="email" id="Email" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="Enter Email" value="{{$user->email}}" disabled>
          </div>
          <div class="form-group">
            <label for="Oldpassword">Old Password</label>
            <input type="password" id="Oldpassword" name="oldpassword" class="@error('oldpassword') is-invalid @enderror form-control" placeholder="Old Password">
          </div>
          <div class="form-group">
            <label for="Password">Change Password</label>
            <input type="password" id="Password" name="password" class="@error('password') is-invalid @enderror form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="Password_confirmation">Confirm New Password</label>
            <input type="password" id="Password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror form-control" placeholder="Confirm Password">
          </div>
          <div class="form-group">
            <label for="profileimage">Profile Image</label>


            <!--<img src="{{env('APP_URL').'/storage/app/'}}{{$user->profileimg}}" height="200px" width="200px">-->
            <img id="ProfileImgPreview" src="{{asset('/storage/'.Auth::user()->profileimg)}}" height="200px" width="200px">


            <div class="input-group">
              <div class="custom-file">
                <input type="file" id="profileimage" name="profileimage" onchange="ShowPreviewImage('profileimage','ProfileImgPreview')" class="@error('profileimage') is-invalid @enderror custom-file-input">
                <label class="custom-file-label" for="profileimage">Choose file</label>
              </div>
              <!--  <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
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
    if ($("#adminprofile").length > 0) {
      $("#adminprofile").validate({
        ignore: [],
        rules: {
          name: {
            required: true,
            maxlength: 50,
            minlength: 3,
          },
          oldpassword: {
            required: {
              depends: function() {
                return $("#Password").val().length > 0
              }
            }
          },
          password: {
            required: {
              depends: function() {
                return $("#Oldpassword").val().length > 0
              }
            },
            minlength: 6,
            maxlength: 50,
          },
          password_confirmation: {
            equalTo: "#Password"
          },
        },
        messages: {
          name: {
            required: "Please enter Name",
          },
          oldpassword: {
            required: "Old password is required to change new password",
          },
          password: {
            required: "Please enter new password",
          },
          password_confirmation: {
            equalTo: "Please enter same password in both fields",
          },
        },
      })
    }
    //frontend validation complete
  })
</script>
@endsection
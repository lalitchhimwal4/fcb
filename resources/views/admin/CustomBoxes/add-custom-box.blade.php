@section('title','Custom Boxes Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Custom box Settings</h1>
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
            <form id="CustomBoxesForm" action="{{route('admin.SaveCustomBox')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-wrap">
                        <h4>Custom Box</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Type">Select Type</label>
                                <select id="Type" name="Type" class="@error('Type') is-invalid @enderror form-control" placeholder="Enter Type" value="">
                                    <option value="homepage">Homepage</option>
                                    <option value="agents-brokers">Agent Brokers - Payors</option>
                                    <option value="providers">Providers</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" id="Title" name="title" class="@error('Title') is-invalid @enderror form-control" placeholder="Enter Title" value="">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea id="Description" name="Description" class="@error('Description') is-invalid @enderror form-control" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Image">Image</label>
                                <img id="ImagePreview" src="#" height="200px" width="200px" style="display:none;">
                                <input type="file" id="Image" name="Image" onchange="ShowPreviewImage('Image','ImagePreview')" class="@error('Image') is-invalid @enderror form-control">
                            </div>
                            <button class="btn btn-success" type="button" id="addbutton">Add Button</button>
                            <section class="custombuttonarea" id="custombuttonarea">
                                <div class="form-group">
                                    <label for="Button_Text">Button Text</label>
                                    <input type="text" id="Button_Text" name="Button_Text" class="@error('Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="">
                                </div>
                                <div class="form-group">
                                    <label for="Button_Link">Button Link</label>
                                    <input type="text" id="Button_Link" name="Button_Link" class="@error('Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="">
                                </div>
                            </section>
                            <button class="btn btn-danger" type="button" id="removebutton">Remove Button</button>
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


        if ($("#CustomBoxesForm").length > 0) {

            $("#CustomBoxesForm").validate({

                rules: {
                    Type: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    Image: {
                        required: true,
                    },
                    Description: {

                        required: true,
                    },
                    Status: {

                        required: true,
                    },
                },
                messages: {

                    Type: {
                        required: "Please select type",
                    },
                    title: {
                        required: "Please enter title",
                    },
                    Image: {
                        required: "Please select image",
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

        //Button text and button link field toggling
        $('#custombuttonarea').hide();
        $('#removebutton').hide();

        $('#addbutton').click(function() {
            $('#custombuttonarea').show();
            $('#removebutton').show();
            $('#addbutton').hide();
        });

        $('#removebutton').click(function() {
            $('#custombuttonarea').hide();
            $('#Button_Text').val("");
            $('#Button_Link').val("");

            $('#removebutton').hide();
            $('#addbutton').show();
        });



    })
</script>
@endsection
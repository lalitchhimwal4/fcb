@section('title','Contact Us Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Contact Us Page Settings</h1>
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
            <form id="ContactUSSettingsForm" action="{{route('admin.SaveSettings','contact-us-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="ContactUs_Settings" name="Settings_Type">
                <div class="card-body">
                    <!--   Section 1    -->
                    <div class="form-wrap">
                        <h4>Section 1</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Heading1">Heading1</label>
                                <input type="text" id="Heading1" name="Heading1" class="@error('Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('ContactUs_Settings','Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Heading2">Heading2</label>
                                <input type="text" id="Heading2" name="Heading2" class="@error('Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('ContactUs_Settings','Heading2')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Contact Form    -->
                    <div class="form-wrap">
                        <h4>Contact Form</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="ContactForm_Heading">Heading</label>
                                <input type="text" id="ContactForm_Heading" name="ContactForm_Heading" class="@error('ContactForm_Heading') is-invalid @enderror form-control" placeholder="Enter Heading" value="{{Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Heading')}}">
                            </div>
                            <div class="form-group">
                                <label for="ContactForm_Text">Text</label>
                                <textarea id="ContactForm_Text" name="ContactForm_Text" class="@error('ContactForm_Text') is-invalid @enderror form-control" placeholder="Enter Text">{{Get_Meta_Tag_Value('ContactUs_Settings','ContactForm_Text')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Meta tags   -->
                    <div class="form-wrap">
                        <h4>Meta Tags Section</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="MetaTitle">Meta Title</label>
                                <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{Get_Meta_Tag_Value('ContactUs_Settings','Meta_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaKeyword">Meta Keyword</label>
                                <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{Get_Meta_Tag_Value('ContactUs_Settings','Meta_Keyword')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaDescription">Meta Description</label>
                                <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{Get_Meta_Tag_Value('ContactUs_Settings','Meta_Description')}}">
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
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
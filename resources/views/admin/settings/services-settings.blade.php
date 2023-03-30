@section('title','Services Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Services Page Settings</h1>
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
            <form id="ServicesSettingsForm" action="{{route('admin.SaveSettings','services-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Services_Settings" name="Settings_Type">
                <div class="card-body">
                    <!--   Section 1    -->
                    <div class="form-wrap">
                        <h4>Section 1</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section1_Heading1">Heading1</label>
                                <input type="text" id="Section1_Heading1" name="Section1_Heading1" class="@error('Section1_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Services_Settings','Section1_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Heading2">Heading2</label>
                                <input type="text" id="Section1_Heading2" name="Section1_Heading2" class="@error('Section1_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Services_Settings','Section1_Heading2')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Section 2    -->
                    <div class="form-wrap">
                        <h4>Section 2</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section2_Heading">Heading</label>
                                <input type="text" id="Section2_Heading" name="Section2_Heading" class="@error('Section2_Heading') is-invalid @enderror form-control" placeholder="Enter Heading" value="{{Get_Meta_Tag_Value('Services_Settings','Section2_Heading')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section2_Description">Description</label>
                                <input type="text" id="Section2_Description" name="Section2_Description" class="@error('Section2_Description') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Services_Settings','Section2_Description')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Section 6   -->
                    <div class="form-wrap">
                        <h4>Section 4</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section4_Heading1">Heading1</label>
                                <input type="text" id="Section4_Heading1" name="Section4_Heading1" class="@error('Section4_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Heading2">Heading2</label>
                                <input type="text" id="Section4_Heading2" name="Section4_Heading2" class="@error('Section4_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Heading2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button1_Text">Button1 Text</label>
                                <input type="text" id="Section4_Button1_Text" name="Section4_Button1_Text" class="@error('Section4_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section4_Button1_Link" name="Section4_Button1_Link" class="@error('Section4_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button2_Text">Button2 Text</label>
                                <input type="text" id="Section4_Button2_Text" name="Section4_Button2_Text" class="@error('Section4_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section4_Button2_Link" name="Section4_Button2_Link" class="@error('Section4_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Services_Settings','Section4_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Meta tags -->
                    <div class="form-wrap">
                        <h4>Meta Tags Section</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="MetaTitle">Meta Title</label>
                                <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{Get_Meta_Tag_Value('Services_Settings','Meta_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaKeyword">Meta Keyword</label>
                                <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{Get_Meta_Tag_Value('Services_Settings','Meta_Keyword')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaDescription">Meta Description</label>
                                <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{Get_Meta_Tag_Value('Services_Settings','Meta_Description')}}">
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
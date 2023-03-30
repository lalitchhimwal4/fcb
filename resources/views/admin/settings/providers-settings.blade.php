@section('title','Providers Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Providers Settings</h1>
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
            <form id="ProvidersSettingsForm" action="{{route('admin.SaveSettings','providers-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Providers_Settings" name="Settings_Type">
                <div class="card-body upload-img">
                    <!--   Section 1    -->
                    <div class="form-wrap">
                        <h4>Section 1</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section1_Heading1">Heading1</label>
                                <input type="text" id="Section1_Heading1" name="Section1_Heading1" class="@error('Section1_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Heading2">Heading2</label>
                                <textarea id="Section1_Heading2" name="Section1_Heading2" class="@error('Section1_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2">{{Get_Meta_Tag_Value('Providers_Settings','Section1_Heading2')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Description">Description</label>
                                <textarea id="Section1_Description" name="Section1_Description" class="@error('Section1_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section1_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Text">Button1 Text</label>
                                <input type="text" id="Section1_Button1_Text" name="Section1_Button1_Text" class="@error('Section1_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button1_Link" name="Section1_Button1_Link" class="@error('Section1_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Text">Button2 Text</label>
                                <input type="text" id="Section1_Button2_Text" name="Section1_Button2_Text" class="@error('Section1_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button2_Link" name="Section1_Button2_Link" class="@error('Section1_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section1_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Section 2    -->
                    <div class="form-wrap">
                        <h4>Section 2</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section2_Heading1">Heading1</label>
                                <input type="text" id="Section2_Heading1" name="Section2_Heading1" class="@error('Section2_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section2_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section2_Description">Description</label>
                                <textarea id="Section2_Description" name="Section2_Description" class="@error('Section2_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section2_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!--   Section 3    -->
                    <div class="form-wrap">
                        <h4>Section 3</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section3_Image1">Section3 Image1</label>
                                <img id="Section3_Image1_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image1')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image1')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image1" name="Section3_Image1" onchange="ShowPreviewImage('Section3_Image1','Section3_Image1_Preview')" class="@error('Section3_Image1') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image1_Title">Section3 Image1 Title</label>
                                <input type="text" id="Section3_Image1_Title" name="Section3_Image1_Title" class="@error('Section3_Image1_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image1_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image2">Section3 Image2</label>
                                <img id="Section3_Image2_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image2')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image2')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image2" name="Section3_Image2" onchange="ShowPreviewImage('Section3_Image2','Section3_Image2_Preview')" class="@error('Section3_Image2') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image2_Title">Section3 Image2 Title</label>
                                <input type="text" id="Section3_Image2_Title" name="Section3_Image2_Title" class="@error('Section3_Image2_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image2_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image3">Section3 Image3</label>
                                <img id="Section3_Image3_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image3')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image3')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image3" name="Section3_Image3" onchange="ShowPreviewImage('Section3_Image3','Section3_Image3_Preview')" class="@error('Section3_Image3') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image3_Title">Section3 Image3 Title</label>
                                <input type="text" id="Section3_Image3_Title" name="Section3_Image3_Title" class="@error('Section3_Image3_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image3_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image4">Section3 Image4</label>
                                <img id="Section3_Image4_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image4')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image4')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image4" name="Section3_Image4" onchange="ShowPreviewImage('Section3_Image4','Section3_Image4_Preview')" class="@error('Section3_Image4') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image4_Title">Section3 Image4 Title</label>
                                <input type="text" id="Section3_Image4_Title" name="Section3_Image4_Title" class="@error('Section3_Image4_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image4_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image5">Section3 Image5</label>
                                <img id="Section3_Image5_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image5')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image5')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image5" name="Section3_Image5" onchange="ShowPreviewImage('Section3_Image5','Section3_Image5_Preview')" class="@error('Section3_Image5') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image5_Title">Section3 Image5 Title</label>
                                <input type="text" id="Section3_Image5_Title" name="Section3_Image5_Title" class="@error('Section3_Image5_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image5_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image6">Section3 Image6</label>
                                <img id="Section3_Image6_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image6')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section3_Image6')):''}}" height="200" width="200">
                                <input type="file" id="Section3_Image6" name="Section3_Image6" onchange="ShowPreviewImage('Section3_Image6','Section3_Image6_Preview')" class="@error('Section3_Image6') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Image6_Title">Section3 Image6 Title</label>
                                <input type="text" id="Section3_Image6_Title" name="Section3_Image6_Title" class="@error('Section3_Image6_Title') is-invalid @enderror form-control" placeholder="Enter title" value="{{Get_Meta_Tag_Value('Providers_Settings','Section3_Image6_Title')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Section 4    -->
                    <div class="form-wrap">
                        <h4>Section 4</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section4_Image">Section4 Image</label>
                                <img id="Section4_Image_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section4_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section4_Image')):''}}" height="200" width="200">
                                <input type="file" id="Section4_Image" name="Section4_Image" onchange="ShowPreviewImage('Section4_Image','Section4_Image_Preview')" class="@error('Section4_Image') is-invalid @enderror form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Section4_Button_Text">Button Text</label>
                            <input type="text" id="Section4_Button_Text" name="Section4_Button_Text" class="@error('Section4_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Text')}}">
                        </div>
                        <div class="form-group">
                            <label for="Section4_Button_Link">Button Link ({{url('/')}}/)</label>
                            <input type="text" id="Section4_Button_Link" name="Section4_Button_Link" class="@error('Section4_Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section4_Button_Link')}}">
                        </div>
                    </div>
                    <!-- Section 5   -->
                    <div class="form-wrap">
                        <h4>Section 5</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section5_Image">Section5 Image</label>
                                <img id="Section5_Image_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section5_Image')):''}}" height="200" width="200">
                                <input type="file" id="Section5_Image" name="Section5_Image" onchange="ShowPreviewImage('Section5_Image','Section5_Image_Preview')" class="@error('Section5_Image') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Heading1">Heading1</label>
                                <input type="text" id="Section5_Heading1" name="Section5_Heading1" class="@error('Section5_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Description">Description</label>
                                <textarea id="Section5_Description" name="Section5_Description" class="@error('Section5_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section5_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section5_Button_Text">Button Text</label>
                                <input type="text" id="Section5_Button_Text" name="Section5_Button_Text" class="@error('Section5_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Button_Link">Button Link ({{url('/')}}/)</label>
                                <input type="text" id="Section5_Button_Link" name="Section5_Button_Link" class="@error('Section5_Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section5_Button_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Section 6   -->
                    <div class="form-wrap">
                        <h4>Section 6</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section6_CounterNo">Counter No.</label>
                                <input type="text" id="Section6_CounterNo" name="Section6_CounterNo" class="@error('Section6_CounterNo') is-invalid @enderror form-control" placeholder="Enter Counter No." value="{{Get_Meta_Tag_Value('Providers_Settings','Section6_CounterNo')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_CounterText">Counter Text</label>
                                <input type="text" id="Section6_CounterText" name="Section6_CounterText" class="@error('Section6_CounterText') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section6_CounterText')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Button_Text">Button Text</label>
                                <input type="text" id="Section6_Button_Text" name="Section6_Button_Text" class="@error('Section6_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Button_Link">Button Link ({{url('/')}}/)</label>
                                <input type="text" id="Section6_Button_Link" name="Section6_Button_Link" class="@error('Section6_Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section6_Button_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Heading1">Heading1</label>
                                <input type="text" id="Section6_Heading1" name="Section6_Heading1" class="@error('Section6_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section6_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Description">Description</label>
                                <textarea id="Section6_Description" name="Section6_Description" class="@error('Section6_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section6_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Section 7   -->
                    <div class="form-wrap">
                        <h4>Section 7</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section7_Image">Section7 Image</label>
                                <img id="Section7_Image_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Image')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section7_Image')):''}}" height="200" width="200">
                                <input type="file" id="Section7_Image" name="Section7_Image" onchange="ShowPreviewImage('Section7_Image','Section7_Image_Preview')" class="@error('Section7_Image') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Heading1">Heading1</label>
                                <input type="text" id="Section7_Heading1" name="Section7_Heading1" class="@error('Section7_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Description">Description</label>
                                <textarea id="Section7_Description" name="Section7_Description" class="@error('Section7_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section7_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section7_Button_Text">Button Text</label>
                                <input type="text" id="Section7_Button_Text" name="Section7_Button_Text" class="@error('Section7_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Button_Link">Button Link ({{url('/')}}/)</label>
                                <input type="text" id="Section7_Button_Link" name="Section7_Button_Link" class="@error('Section7_Button_Link') is-invalid @enderror form-control" placeholder="Enter Button Link" value="{{Get_Meta_Tag_Value('Providers_Settings','Section7_Button_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Section 8   -->
                    <div class="form-wrap">
                        <h4>Section 8</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section8_Desktop_Banner"> Desktop Banner</label>
                                <img id="Section8_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Desktop_Banner')):''}}" height="200" width="200">
                                <input type="file" id="Section8_Desktop_Banner" name="Section8_Desktop_Banner" onchange="ShowPreviewImage('Section8_Desktop_Banner','Section8_Desktop_Banner_Preview')" class="@error('Section8_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Mobile_Banner1">Mobile Banner1</label>
                                <img id="Section8_Mobile_Banner1_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner1')):''}}" height="200" width="200">
                                <input type="file" id="Section8_Mobile_Banner1" name="Section8_Mobile_Banner1" onchange="ShowPreviewImage('Section8_Mobile_Banner1','Section8_Mobile_Banner1_Preview')" class="@error('Section8_Mobile_Banner1') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Mobile_Banner2">Mobile Banner2</label>
                                <img id="Section8_Mobile_Banner2_Preview" src="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')?asset('/storage/'.Get_Meta_Tag_Value('Providers_Settings','Section8_Mobile_Banner2')):''}}" height="200" width="200">
                                <input type="file" id="Section8_Mobile_Banner2" name="Section8_Mobile_Banner2" onchange="ShowPreviewImage('Section8_Mobile_Banner2','Section8_Mobile_Banner2_Preview')" class="@error('Section8_Mobile_Banner2') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Heading1">Heading1</label>
                                <input type="text" id="Section8_Heading1" name="Section8_Heading1" class="@error('Section8_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Heading2">Heading2</label>
                                <input type="text" id="Section8_Heading2" name="Section8_Heading2" class="@error('Section8_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Providers_Settings','Section8_Heading2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Description">Description</label>
                                <textarea id="Section8_Description" name="Section8_Description" class="@error('Section8_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Providers_Settings','Section8_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section8_Button1_Text">Button1 Text</label>
                                <input type="text" id="section8_Button1_Text" name="section8_Button1_Text" class="@error('section8_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="section8_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="section8_Button1_Link" name="section8_Button1_Link" class="@error('section8_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="section8_Button2_Text">Button2 Text</label>
                                <input type="text" id="section8_Button2_Text" name="section8_Button2_Text" class="@error('section8_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="section8_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="section8_Button2_Link" name="section8_Button2_Link" class="@error('section8_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Providers_Settings','section8_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Meta tags   -->
                    <div class="form-wrap">
                        <h4>Meta Tags Section</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="MetaTitle">Meta Title</label>
                                <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{Get_Meta_Tag_Value('Providers_Settings','Meta_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaKeyword">Meta Keyword</label>
                                <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{Get_Meta_Tag_Value('Providers_Settings','Meta_Keyword')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaDescription">Meta Description</label>
                                <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{Get_Meta_Tag_Value('Providers_Settings','Meta_Description')}}">
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
@section('footerjs')
<script>
    $(document).ready(function() {

        //ckeditor
        ckeditor('Section5_Description', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");
        ckeditor('Section7_Description', "{{route('CKeditorImageUpload', ['_token' => csrf_token() ])}}");


    })
</script>
@endsection
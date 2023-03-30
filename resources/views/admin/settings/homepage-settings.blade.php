@section('title','Homepage Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Homepage Settings</h1>
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
            <form id="HomepageSettingsForm" action="{{route('admin.SaveSettings','homepage-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Homepage_Settings" name="Settings_Type">
                <div class="card-body upload-img">
                    <!--   Hero (Section 1)    -->
                    <div class="form-wrap">
                        <h4>Hero</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section1_Heading1">Heading1</label>
                                <input type="text" id="Section1_Heading1" name="Section1_Heading1" class="@error('Section1_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Heading2">Heading2</label>
                                <textarea id="Section1_Heading2" name="Section1_Heading2" class="@error('Section1_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2">{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Heading2')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Description">Description</label>
                                <textarea id="Section1_Description" name="Section1_Description" class="@error('Section1_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Text">Button1 Text</label>
                                <input type="text" id="Section1_Button1_Text" name="Section1_Button1_Text" class="@error('Section1_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button1_Link" name="Section1_Button1_Link" class="@error('Section1_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Text">Button2 Text</label>
                                <input type="text" id="Section1_Button2_Text" name="Section1_Button2_Text" class="@error('Section1_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button2_Link" name="Section1_Button2_Link" class="@error('Section1_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section1_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Who We Are (Section 3)    -->
                    <div class="form-wrap">
                        <h4>Who We Are</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section3_Heading1">Heading1</label>
                                <input type="text" id="Section3_Heading1" name="Section3_Heading1" class="@error('Section3_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section3_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Description">Description</label>
                                <textarea id="Section3_Description" name="Section3_Description" class="@error('Section3_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section3_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!--   How it Works (Section 4)    -->
                    <div class="form-wrap">
                        <h4>How it Works</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section4_Heading1">Heading1</label>
                                <input type="text" id="Section4_Heading1" name="Section4_Heading1" class="@error('Section4_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Description">Description</label>
                                <textarea id="Section4_Description" name="Section4_Description" class="@error('Section4_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section4_Quote">Quote</label>
                                <textarea id="Section4_Quote" name="Section4_Quote" class="@error('Section4_Quote') is-invalid @enderror form-control" placeholder="Enter Quote">{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Quote')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button_Text">Button Text</label>
                                <input type="text" id="Section4_Button_Text" name="Section4_Button_Text" class="@error('Section4_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Button_Link">Button Link ({{url('/')}}/)</label>
                                <input type="text" id="Section4_Button_Link" name="Section4_Button_Link" class="@error('Section4_Button_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Button_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Counters (Section 5)   -->
                    <div class="form-wrap">
                        <h4>Counters</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section5_Counter1">Counter1 value</label>
                                <input type="text" id="Section5_Counter1" name="Section5_Counter1" class="@error('Section5_Counter1') is-invalid @enderror form-control" placeholder="Enter Section5 Counter1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Counter1_Text">Counter1 text</label>
                                <input type="text" id="Section5_Counter1_Text" name="Section5_Counter1_Text" class="@error('Section5_Counter1_Text') is-invalid @enderror form-control" placeholder="Enter Section5 Counter1 text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Counter2">Counter2 value</label>
                                <input type="text" id="Section5_Counter2" name="Section5_Counter2" class="@error('Section5_Counter2') is-invalid @enderror form-control" placeholder="Enter Section5 Counter2" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Counter2_Text">Counter2 text</label>
                                <input type="text" id="Section5_Counter2_Text" name="Section5_Counter2_Text" class="@error('Section5_Counter2_Text') is-invalid @enderror form-control" placeholder="Enter Section5 Counter2 text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Counter3">Counter3 value</label>
                                <input type="text" id="Section5_Counter3" name="Section5_Counter3" class="@error('Section5_Counter3') is-invalid @enderror form-control" placeholder="Enter Section5_Counter3" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section5_Counter3')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Counter3_Text">Counter3 text</label>
                                <input type="text" id="Section5_Counter3_Text" name="Section5_Counter3_Text" class="@error('Section5_Counter3_Text') is-invalid @enderror form-control" placeholder="Enter Section5 Counter3 text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section4_Counter3_Text')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Our Future (Section 2)   -->
                    <div class="form-wrap">
                        <h4>Our Future</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section2_Heading1">Heading1</label>
                                <input type="text" id="Section2_Heading1" name="Section2_Heading1" class="@error('Section2_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section2_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section2_Description">Description</label>
                                <textarea id="Section2_Description" name="Section2_Description" class="@error('Section2_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section2_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!--   Our Promise to Community (Section 8)   -->
                    <div class="form-wrap">
                        <h4>Our Promise to Community</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section8_Heading1">Heading1</label>
                                <input type="text" id="Section8_Heading1" name="Section8_Heading1" class="@error('Section8_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Description">Description</label>
                                <textarea id="Section8_Description" name="Section8_Description" class="@error('Section8_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section8_Heading2">Heading2</label>
                                <input type="text" id="Section8_Heading2" name="Section8_Heading2" class="@error('Section8_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Heading2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Description2">Description2</label>
                                <textarea id="Section8_Description2" name="Section8_Description2" class="@error('Section8_Description2') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Description2')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section8_Description3">Description3</label>
                                <textarea id="Section8_Description3" name="Section8_Description3" class="@error('Section8_Description3') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section8_Description3')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- What We Do (Section 6)  -->
                    <div class="form-wrap">
                        <h4>What We Do</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section6_Heading1">Heading1</label>
                                <input type="text" id="Section6_Heading1" name="Section6_Heading1" class="@error('Section6_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Description">Description</label>
                                <textarea id="Section6_Description" name="Section6_Description" class="@error('Section6_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section6_Button_Text">Button Text</label>
                                <input type="text" id="Section6_Button_Text" name="Section6_Button_Text" class="@error('Section6_Button_Text') is-invalid @enderror form-control" placeholder="Enter Button Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section6_Button_Text')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Join Our Network (Section 7)  -->
                    <div class="form-wrap">
                        <h4>Join Our Network</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section7_Desktop_Banner"> Desktop Banner</label>
                                <img id="Section7_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Homepage_Settings','Section7_Desktop_Banner')):asset('/frontend_assets/images/bg-join.jpg');}}" height="200" width="200">
                                <input type="file" id="Section7_Desktop_Banner" name="Section7_Desktop_Banner" onchange="ShowPreviewImage('Section7_Desktop_Banner','Section7_Desktop_Banner_Preview')" class="@error('Section7_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Mobile_Banner1">Mobile Banner1</label>
                                <img id="Section7_Mobile_Banner1_Preview" src="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner1')?asset('/storage/'.Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner1')):asset('/frontend_assets/images/join-first.jpg');}}" height="200" width="200">
                                <input type="file" id="Section7_Mobile_Banner1" name="Section7_Mobile_Banner1" onchange="ShowPreviewImage('Section7_Mobile_Banner1','Section7_Mobile_Banner1_Preview')" class="@error('Section7_Mobile_Banner1') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Mobile_Banner2">Mobile Banner2</label>
                                <img id="Section7_Mobile_Banner2_Preview" src="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner2')?asset('/storage/'.Get_Meta_Tag_Value('Homepage_Settings','Section7_Mobile_Banner2')):asset('/frontend_assets/images/join-second.jpg');}}" height="200" width="200">
                                <input type="file" id="Section7_Mobile_Banner2" name="Section7_Mobile_Banner2" onchange="ShowPreviewImage('Section7_Mobile_Banner2','Section7_Mobile_Banner2_Preview')" class="@error('Section7_Mobile_Banner2') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Heading1">Heading1</label>
                                <input type="text" id="Section7_Heading1" name="Section7_Heading1" class="@error('Section7_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Heading2">Heading2</label>
                                <input type="text" id="Section7_Heading2" name="Section7_Heading2" class="@error('Section7_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Heading2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Description">Description</label>
                                <textarea id="Section7_Description" name="Section7_Description" class="@error('Section7_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section7_Button1_Text">Button1 Text</label>
                                <input type="text" id="Section7_Button1_Text" name="Section7_Button1_Text" class="@error('Section7_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section7_Button1_Link" name="Section7_Button1_Link" class="@error('Section7_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Button2_Text">Button2 Text</label>
                                <input type="text" id="Section7_Button2_Text" name="Section7_Button2_Text" class="@error('Section7_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section7_Button2_Link" name="Section7_Button2_Link" class="@error('Section7_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Homepage_Settings','Section7_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!-- Meta tags   -->
                    <div class="form-wrap">
                        <h4>Meta Tags Section</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="MetaTitle">Meta Title</label>
                                <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{Get_Meta_Tag_Value('Homepage_Settings','Meta_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaKeyword">Meta Keyword</label>
                                <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{Get_Meta_Tag_Value('Homepage_Settings','Meta_Keyword')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaDescription">Meta Description</label>
                                <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{Get_Meta_Tag_Value('Homepage_Settings','Meta_Description')}}">
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
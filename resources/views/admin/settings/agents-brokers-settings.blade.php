@section('title','Payors-Agents Brokers Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Payors(Agents-Brokers) Settings</h1>
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
            <form id="Agents_BrokersSettingsForm" action="{{route('admin.SaveSettings','agents-brokers-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Agents_Brokers_Settings" name="Settings_Type">
                <div class="card-body upload-img">
                    <!--   Section 1    -->
                    <div class="form-wrap">
                        <h4>Section 1</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section1_Heading1">Heading1</label>
                                <textarea id="Section1_Heading1" name="Section1_Heading1" class="@error('Section1_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading1')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Heading2">Heading2</label>
                                <input type="text" id="Section1_Heading2" name="Section1_Heading2" class="@error('Section1_Heading2') is-invalid @enderror form-control" placeholder="Enter Heading2" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Heading2')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Description">Description</label>
                                <textarea id="Section1_Description" name="Section1_Description" class="@error('Section1_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Text">Button1 Text</label>
                                <input type="text" id="Section1_Button1_Text" name="Section1_Button1_Text" class="@error('Section1_Button1_Text') is-invalid @enderror form-control" placeholder="Enter Button1 Text" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button1_Link">Button1 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button1_Link" name="Section1_Button1_Link" class="@error('Section1_Button1_Link') is-invalid @enderror form-control" placeholder="Enter Button1 Link" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button1_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Text">Button2 Text</label>
                                <input type="text" id="Section1_Button2_Text" name="Section1_Button2_Text" class="@error('Section1_Button2_Text') is-invalid @enderror form-control" placeholder="Enter Button2 Text" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section1_Button2_Link">Button2 Link ({{url('/')}}/)</label>
                                <input type="text" id="Section1_Button2_Link" name="Section1_Button2_Link" class="@error('Section1_Button2_Link') is-invalid @enderror form-control" placeholder="Enter Button2 Link" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section1_Button2_Link')}}">
                            </div>
                        </div>
                    </div>
                    <!--   Section 2    -->
                    <div class="form-wrap">
                        <h4>Section 2</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section2_Heading1">Heading1</label>
                                <input type="text" id="Section2_Heading1" name="Section2_Heading1" class="@error('Section2_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section2_Description">Description</label>
                                <textarea id="Section2_Description" name="Section2_Description" class="@error('Section2_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section2_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!--   Section 3    -->
                    <div class="form-wrap">
                        <h4>Section 3</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section2_Heading1">Heading1</label>
                                <input type="text" id="Section3_Heading1" name="Section3_Heading1" class="@error('Section3_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section3_Highlighted_Description">Highlighted Description</label>
                                <textarea id="Section3_Highlighted_Description" name="Section3_Highlighted_Description" class="@error('Section3_Highlighted_Description') is-invalid @enderror form-control" placeholder="Enter Highlighted Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Highlighted_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section3_Description">Description</label>
                                <textarea id="Section3_Description" name="Section3_Description" class="@error('Section3_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section3_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Section 4   -->
                    <div class="form-wrap">
                        <h4>Section 4</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section4_Heading1">Heading1</label>
                                <input type="text" id="Section4_Heading1" name="Section4_Heading1" class="@error('Section4_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section4_Description">Description</label>
                                <textarea id="Section4_Description" name="Section4_Description" class="@error('Section4_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section4_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Section 5 -->
                    <div class="form-wrap">
                        <h4>Section 5</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section5_Heading1">Heading1</label>
                                <input type="text" id="Section5_Heading1" name="Section5_Heading1" class="@error('Section5_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section5_Description">Description</label>
                                <textarea id="Section5_Description" name="Section5_Description" class="@error('Section5_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section5_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Section 6   -->
                    <div class="form-wrap">
                        <h4>Section 6</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section6_Heading1">Heading1</label>
                                <input type="text" id="Section6_Heading1" name="Section6_Heading1" class="@error('Section6_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Image1">Image1</label>
                                <img id="Section6_Image1_Preview" src="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Image1')?asset('/storage/'.Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Image1')):asset('frontend_assets/images/Simple_Red_and_Beige_Vintage_Illustration_History_Class_Education_Presentation.png')}}" height="200" width="200">
                                <input type="file" id="Section6_Image1" name="Section6_Image1" onchange="ShowPreviewImage('Section6_Image1','Section6_Image1_Preview')" class="@error('Section6_Image1') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Section6_Description">Description</label>
                                <textarea id="Section6_Description" name="Section6_Description" class="@error('Section6_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section6_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Section 7   -->
                    <div class="form-wrap">
                        <h4>Section 7</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section7_Heading1">Heading1</label>
                                <input type="text" id="Section7_Heading1" name="Section7_Heading1" class="@error('Section7_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section7_Description">Description</label>
                                <textarea id="Section7_Description" name="Section7_Description" class="@error('Section7_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Section7_Image1">Image1</label>
                                <img id="Section7_Image1_Preview" src="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Image1')?asset('/storage/'.Get_Meta_Tag_Value('Agents_Brokers_Settings','Section7_Image1')):asset('/frontend_assets/images/tooth.png')}}" height="200" width="200">
                                <input type="file" id="Section7_Image1" name="Section7_Image1" onchange="ShowPreviewImage('Section7_Image1','Section7_Image1_Preview')" class="@error('Section7_Image1') is-invalid @enderror form-control">
                            </div>
                        </div>
                    </div>
                    <!-- Section 8 -->
                    <div class="form-wrap">
                        <h4>Section 8</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Section8_Heading1">Heading1</label>
                                <input type="text" id="Section8_Heading1" name="Section8_Heading1" class="@error('Section8_Heading1') is-invalid @enderror form-control" placeholder="Enter Heading1" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Heading1')}}">
                            </div>
                            <div class="form-group">
                                <label for="Section8_Description">Description</label>
                                <textarea id="Section8_Description" name="Section8_Description" class="@error('Section8_Description') is-invalid @enderror form-control" placeholder="Enter Description">{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Section8_Description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Meta tags   -->
                    <div class="form-wrap">
                        <h4>Meta Tags Section</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="MetaTitle">Meta Title</label>
                                <input type="text" id="MetaTitle" name="Meta_Title" class="@error('MetaTitle') is-invalid @enderror form-control" placeholder="Meta Title" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaKeyword">Meta Keyword</label>
                                <input type="text" id="MetaKeyword" name="Meta_Keyword" class="@error('MetaKeyword') is-invalid @enderror form-control" placeholder="Meta Keyword" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Keyword')}}">
                            </div>
                            <div class="form-group">
                                <label for="MetaDescription">Meta Description</label>
                                <input type="text" id="MetaDescription" name="Meta_Description" class="@error('MetaDescription') is-invalid @enderror form-control" placeholder="Meta Description" value="{{Get_Meta_Tag_Value('Agents_Brokers_Settings','Meta_Description')}}">
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
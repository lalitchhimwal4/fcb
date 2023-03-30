@section('title','General Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">General Settings</h1>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="">
            @include('showmessages')
            <form id="GeneralSettingsForm" action="{{route('admin.SaveSettings','general-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="General_Settings" name="Settings_Type">
                <div class="card-body upload-img card-body-wrapper">
                    <div class="form-wrap">
                        <h4>Logo</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Header_Logo">Website Header Logo</label>
                                <img id="Header_Logo_Preview" src="{{Get_Meta_Tag_Value('General_Settings','Header_Logo')?asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Header_Logo')):asset('frontend_assets/images/logo.png');}}" height="100px" widht="100px">
                                <input type="file" id="Header_Logo" name="Header_Logo" onchange="ShowPreviewImage('Header_Logo','Header_Logo_Preview')" class="@error('Header_Logo') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Footer_Logo">Website Footer Logo</label>
                                <img id="Footer_Logo_Preview" src="{{Get_Meta_Tag_Value('General_Settings','Footer_Logo')?asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo')):asset('frontend_assets/images/footer-logo.png');}}" height="100px" widht="100px">
                                <input type="file" id="Footer_Logo" name="Footer_Logo" onchange="ShowPreviewImage('Footer_Logo','Footer_Logo_Preview')" class="@error('Footer_Logo') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Footer_Logo2">Footer Logo2</label>
                                <img id="Footer_Logo2_Preview" src="{{Get_Meta_Tag_Value('General_Settings','Footer_Logo2')?asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo2')):asset('frontend_assets/images/omca-logo.jpg');}}" height="100px" widht="100px">
                                <input type="file" id="Footer_Logo2" name="Footer_Logo2" onchange="ShowPreviewImage('Footer_Logo2','Footer_Logo2_Preview')" class="@error('Footer_Logo2') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Footer_Logo2_Text">Footer Logo2 Text</label>
                                <input type="text" id="Footer_Logo2_Text" name="Footer_Logo2_Text" class="@error('Footer_Logo2_Text') is-invalid @enderror form-control" placeholder="Enter Footer Logo2 Text" value="{{Get_Meta_Tag_Value('General_Settings','Footer_Logo2_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="Footer_Logo3">Footer Logo3</label>
                                <img id="Footer_Logo3_Preview" src="{{Get_Meta_Tag_Value('General_Settings','Footer_Logo3')?asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Footer_Logo3')):asset('frontend_assets/images/cmca-logo.jpg');}}" height="100px" widht="100px">
                                <input type="file" id="Footer_Logo3" name="Footer_Logo3" onchange="ShowPreviewImage('Footer_Logo3','Footer_Logo3_Preview')" class="@error('Footer_Logo3') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Footer_Logo3_Text">Footer Logo3 Text</label>
                                <input type="text" id="Footer_Logo3_Text" name="Footer_Logo3_Text" class="@error('Footer_Logo3_Text') is-invalid @enderror form-control" placeholder="Enter Footer Logo3 Text" value="{{Get_Meta_Tag_Value('General_Settings','Footer_Logo3_Text')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4> Admin Contact Details</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Company_Address">Company Address</label>
                                <textarea id="Company_Address" name="Company_Address" class="@error('Company_Address') is-invalid @enderror form-control" placeholder="Enter Company Address"> {{Get_Meta_Tag_Value('General_Settings','Company_Address')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Phone">Admin Telephone</label>
                                <input type="tel" id="Phone" name="Admin_Phone" class="@error('Phone') is-invalid @enderror form-control" placeholder="Enter Admin Phone" value="{{Get_Meta_Tag_Value('General_Settings','Admin_Phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="Tollfree">Tollfree No.</label>
                                <input type="tel" id="Tollfree" name="Tollfree" class="@error('Tollfree') is-invalid @enderror form-control" placeholder="Enter Tollfree No." value="{{Get_Meta_Tag_Value('General_Settings','Tollfree')}}">
                            </div>
                            <div class="form-group">
                                <label for="Fax">Fax</label>
                                <input type="text" id="Fax" name="Fax" class="@error('Fax') is-invalid @enderror form-control" placeholder="Enter Fax" value="{{Get_Meta_Tag_Value('General_Settings','Fax')}}">
                            </div>
                            <div class="form-group">
                                <label for="Email">Admin Email</label>
                                <input type="email" id="Email" name="Admin_Email" class="@error('Email') is-invalid @enderror form-control" placeholder="Enter Admin Email" value="{{Get_Meta_Tag_Value('General_Settings','Admin_Email')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Payors\Providers\Members Contact Details</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Payor_Provider_Member_Telephone">Telephone</label>
                                <input type="tel" id="Payor_Provider_Member_Telephone" name="Payor_Provider_Member_Telephone" class="@error('Payor_Provider_Member_Telephone') is-invalid @enderror form-control" placeholder="Enter TelePhone" value="{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Telephone')}}">
                            </div>
                            <div class="form-group">
                                <label for="Payor_Provider_Member_Tollfree">Tollfree No.</label>
                                <input type="tel" id="Payor_Provider_Member_Tollfree" name="Payor_Provider_Member_Tollfree" class="@error('Payor_Provider_Member_Tollfree') is-invalid @enderror form-control" placeholder="Enter Tollfree No." value="{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Tollfree')}}">
                            </div>
                            <div class="form-group">
                                <label for="Payor_Provider_Member_Fax">Fax</label>
                                <input type="text" id="Payor_Provider_Member_Fax" name="Payor_Provider_Member_Fax" class="@error('Payor_Provider_Member_Fax') is-invalid @enderror form-control" placeholder="Enter Fax" value="{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Fax')}}">
                            </div>
                            <div class="form-group">
                                <label for="Payor_Provider_Member_Email">Email</label>
                                <input type="email" id="Payor_Provider_Member_Email" name="Payor_Provider_Member_Email" class="@error('Payor_Provider_Member_Email') is-invalid @enderror form-control" placeholder="Enter Email" value="{{Get_Meta_Tag_Value('General_Settings','Payor_Provider_Member_Email')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Administrators, Agents and Brokers Contact Details</h4>
                        <div class="form-inner">

                            <div class="form-group">
                                <label for="Admins_Agents_Brokers_Telephone">Telephone</label>
                                <input type="tel" id="Admins_Agents_Brokers_Telephone" name="Admins_Agents_Brokers_Telephone" class="@error('Admins_Agents_Brokers_Telephone') is-invalid @enderror form-control" placeholder="Enter TelePhone" value="{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Telephone')}}">
                            </div>
                            <div class="form-group">
                                <label for="Admins_Agents_Brokers_Tollfree">Tollfree No.</label>
                                <input type="tel" id="Admins_Agents_Brokers_Tollfree" name="Admins_Agents_Brokers_Tollfree" class="@error('Admins_Agents_Brokers_Tollfree') is-invalid @enderror form-control" placeholder="Enter Tollfree No." value="{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Tollfree')}}">
                            </div>
                            <div class="form-group">
                                <label for="Admins_Agents_Brokers_Fax">Fax</label>
                                <input type="text" id="Admins_Agents_Brokers_Fax" name="Admins_Agents_Brokers_Fax" class="@error('Admins_Agents_Brokers_Fax') is-invalid @enderror form-control" placeholder="Enter Fax" value="{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Fax')}}">
                            </div>
                            <div class="form-group">
                                <label for="Admins_Agents_Brokers_Email">Email</label>
                                <input type="email" id="Admins_Agents_Brokers_Email" name="Admins_Agents_Brokers_Email" class="@error('Admins_Agents_Brokers_Email') is-invalid @enderror form-control" placeholder="Enter Email" value="{{Get_Meta_Tag_Value('General_Settings','Admins_Agents_Brokers_Email')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Social Links</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Facebook_Link">Facebook Link</label>
                                <input type="text" id="Facebook_Link" name="Facebook_Link" class="@error('Facebook_Link') is-invalid @enderror form-control" placeholder="Enter Facebook Link" value="{{Get_Meta_Tag_Value('General_Settings','Facebook_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Instagram_Link">Instagram Link</label>
                                <input type="text" id="Instagram_Link" name="Instagram_Link" class="@error('Instagram_Link') is-invalid @enderror form-control" placeholder="Enter Instagram Link" value="{{Get_Meta_Tag_Value('General_Settings','Instagram_Link')}}">
                            </div>
                            <div class="form-group">
                                <label for="Google_Link">Google Plus Link</label>
                                <input type="text" id="Google_Link" name="Google_Link" class="@error('Google_Link') is-invalid @enderror form-control" placeholder="Enter Google+ Link" value="{{Get_Meta_Tag_Value('General_Settings','Google_Link')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Trademark</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="TradeMark_Text">TradeMark Text</label>
                                <input type="text" id="TradeMark_Text" name="TradeMark_Text" class="@error('TradeMark_Text') is-invalid @enderror form-control" placeholder="Enter TradeMark Text" value="{{Get_Meta_Tag_Value('General_Settings','TradeMark_Text')}}">
                            </div>
                            <div class="form-group">
                                <label for="TradeMark_Year">TradeMark Year</label>
                                <input type="text" id="TradeMark_Year" name="TradeMark_Year" class="@error('TradeMark_Year') is-invalid @enderror form-control" placeholder="Enter TradeMark Year" value="{{Get_Meta_Tag_Value('General_Settings','TradeMark_Year')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Member Enrollment</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Vision_Portal_Member_Dashboard">Vision Portal</label>
                                <input type="text" id="Vision_Portal_Member_Dashboard" name="Vision_Portal_Member_Dashboard" class="@error('Vision_Portal_Member_Dashboard') is-invalid @enderror form-control" placeholder="Enter Vision Portal Link" value="{{Get_Meta_Tag_Value('General_Settings','Vision_Portal_Member_Dashboard')}}">
                            </div>
                            <div class="form-group">
                                <label for="Pharm_Portal_Member_Dashboard">Pharm Portal</label>
                                <input type="text" id="Pharm_Portal_Member_Dashboard" name="Pharm_Portal_Member_Dashboard" class="@error('Pharm_Portal_Member_Dashboard') is-invalid @enderror form-control" placeholder="Enter Pharm Portal link" value="{{Get_Meta_Tag_Value('General_Settings','Pharm_Portal_Member_Dashboard')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <h4>Google Maps</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Google_Maps_API_Key">API Key</label>
                                <input type="text" id="Google_Maps_API_Key" name="Google_Maps_API_Key" class="@error('Google_Maps_API_Key') is-invalid @enderror form-control" placeholder="Enter Api Key" value="{{Get_Meta_Tag_Value('General_Settings','Google_Maps_API_Key')}}">
                            </div>
                            <div class="form-group">
                                <label for="Google_Maps_Search_Radius">Search Radius</label>
                                <input type="number" id="Google_Maps_Search_Radius" name="Google_Maps_Search_Radius" class="@error('Google_Maps_Search_Radius') is-invalid @enderror form-control" placeholder="Enter maps search radius" value="{{Get_Meta_Tag_Value('General_Settings','Google_Maps_Search_Radius')}}" step="0.01">
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
@section('title','Banner Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Banner Settings</h1>
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
            <form id="BannerSettingsForm" action="{{route('admin.SaveSettings','banner-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Banner_Settings" name="Settings_Type">
                <div class="card-body upload-img">
                    <div class="form-wrap">
                        <h4>Banners</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="Homepage_Desktop_Banner">Homepage Desktop Banner</label>
                                <img id="Homepage_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Homepage_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Homepage_Desktop_Banner')):asset('/frontend_assets/images/hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Homepage_Desktop_Banner" name="Homepage_Desktop_Banner" onchange="ShowPreviewImage('Homepage_Desktop_Banner','Homepage_Desktop_Banner_Preview')" class="@error('Homepage_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Homepage_Mobile_Banner">Homepage Mobile Banner</label>
                                <img id="Homepage_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Homepage_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Homepage_Mobile_Banner')):asset('/frontend_assets/images/res-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Homepage_Mobile_Banner" name="Homepage_Mobile_Banner" onchange="ShowPreviewImage('Homepage_Mobile_Banner','Homepage_Mobile_Banner_Preview')" class="@error('Homepage_Mobile_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Payors_Desktop_Banner">Payors(Agent-Brokers) Desktop Banner</label>
                                <img id="Payors_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Payors_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Payors_Desktop_Banner')):asset('/frontend_assets/images/broker-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Payors_Desktop_Banner" name="Payors_Desktop_Banner" onchange="ShowPreviewImage('Payors_Desktop_Banner','Payors_Desktop_Banner_Preview')" class="@error('Payors_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Payors_Mobile_Banner">Payors(Agent-Brokers) Mobile Banner</label>
                                <img id="Payors_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Payors_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Payors_Mobile_Banner')):asset('/frontend_assets/images/res-broker-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Payors_Mobile_Banner" name="Payors_Mobile_Banner" onchange="ShowPreviewImage('Payors_Mobile_Banner','Payors_Mobile_Banner_Preview')" class="@error('Payors_Mobile_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Prescriptions_Desktop_Banner">Prescriptions Desktop Banner</label>
                                <img id="Prescriptions_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Desktop_Banner')):asset('/frontend_assets/images/scripts-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Prescriptions_Desktop_Banner" name="Prescriptions_Desktop_Banner" onchange="ShowPreviewImage('Prescriptions_Desktop_Banner','Prescriptions_Desktop_Banner_Preview')" class="@error('Prescriptions_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Prescriptions_Mobile_Banner">Prescriptions Mobile Banner</label>
                                <img id="Prescriptions_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Prescriptions_Mobile_Banner')):asset('/frontend_assets/images/res-scripts.jpg');}}" height="200" width="200">
                                <input type="file" id="Prescriptions_Mobile_Banner" name="Prescriptions_Mobile_Banner" onchange="ShowPreviewImage('Prescriptions_Mobile_Banner','Prescriptions_Mobile_Banner_Preview')" class="@error('Prescriptions_Mobile_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Vision_Desktop_Banner">Vision Desktop Banner</label>
                                <img id="Vision_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Vision_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Vision_Desktop_Banner')):asset('/frontend_assets/images/vision-bg-hero.jpg');}}" height="200" width="200">
                                <input type="file" id="Vision_Desktop_Banner" name="Vision_Desktop_Banner" onchange="ShowPreviewImage('Vision_Desktop_Banner','Vision_Desktop_Banner_Preview')" class="@error('Vision_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Vision_Mobile_Banner">Vision Mobile Banner</label>
                                <img id="Vision_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Vision_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Vision_Mobile_Banner')):asset('/frontend_assets/images/res-vision-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Vision_Mobile_Banner" name="Vision_Mobile_Banner" onchange="ShowPreviewImage('Vision_Mobile_Banner','Vision_Mobile_Banner_Preview')" class="@error('Vision_Mobile_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Providers_Desktop_Banner">Providers Desktop Banner</label>
                                <img id="Providers_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Providers_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Providers_Desktop_Banner')):asset('/frontend_assets/images/providers-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Providers_Desktop_Banner" name="Providers_Desktop_Banner" onchange="ShowPreviewImage('Providers_Desktop_Banner','Providers_Desktop_Banner_Preview')" class="@error('Providers_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Providers_Mobile_Banner">Providers Mobile Banner</label>
                                <img id="Providers_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Providers_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Providers_Mobile_Banner')):asset('/frontend_assets/images/res-provider-hero-bg.jpg');}}" height="200" width="200">
                                <input type="file" id="Providers_Mobile_Banner" name="Providers_Mobile_Banner" onchange="ShowPreviewImage('Providers_Mobile_Banner','Providers_Mobile_Banner_Preview')" class="@error('Providers_Mobile_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Plan_Members_Desktop_Banner">Plan Members Desktop Banner</label>
                                <img id="Plan_Members_Desktop_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Desktop_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Desktop_Banner')):asset('/frontend_assets/images/home-hero-1024x451.png');}}" height="200" width="200">
                                <input type="file" id="Plan_Members_Desktop_Banner" name="Plan_Members_Desktop_Banner" onchange="ShowPreviewImage('Plan_Members_Desktop_Banner','Plan_Members_Desktop_Banner_Preview')" class="@error('Plan_Members_Desktop_Banner') is-invalid @enderror form-control">
                            </div>
                            <div class="form-group">
                                <label for="Plan_Members_Mobile_Banner">Plan Members Mobile Banner</label>
                                <img id="Plan_Members_Mobile_Banner_Preview" src="{{Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')?asset('/storage/'.Get_Meta_Tag_Value('Banner_Settings','Plan_Members_Mobile_Banner')):asset('/frontend_assets/images/home-hero-1024x451-bg.png');}}" height="200" width="200">
                                <input type="file" id="Plan_Members_Mobile_Banner" name="Plan_Members_Mobile_Banner" onchange="ShowPreviewImage('Plan_Members_Mobile_Banner','Plan_Members_Mobile_Banner_Preview')" class="@error('Plan_Members_Mobile_Banner') is-invalid @enderror form-control">
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
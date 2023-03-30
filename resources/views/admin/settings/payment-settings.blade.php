@section('title','Payment Settings')
@extends('layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1 class="m-0">Payment Settings</h1>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="">
            @include('showmessages')
            <form id="PaymentSettingsForm" action="{{route('admin.SaveSettings','payment-settings')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="Payment_Settings" name="Settings_Type">
                <div class="card-body upload-img card-body-wrapper">
                    <div class="form-wrap">
                        <h4>Paypal (Member Enrollment and Claims)</h4>
                        <div class="form-inner">
                            <div class="form-group">
                                <label for="paypal_mode">Mode</label>
                                <select id="paypal_mode" name="paypal_mode" class="@error('paypal_mode') is-invalid @enderror form-control">
                                    <option value="sandbox" {{Get_Meta_Tag_Value('Payment_Settings','paypal_mode')=="sandbox"?'selected':''}}>Sandbox</option>
                                    <option value="live" {{Get_Meta_Tag_Value('Payment_Settings','paypal_mode')=="live"?'selected':''}}>Live</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paypal_currency">Currency</label>
                                <select id="paypal_currency" name="paypal_currency" class="@error('paypal_currency') is-invalid @enderror form-control">
                                    <option value="CAD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="CAD"?'selected':''}}>CAD</option>
                                    <option value="USD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="USD"?'selected':''}}>USD</option>
                                    <option value="AUD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="AUD"?'selected':''}}>AUD</option>
                                    <option value="EUR" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="EUR"?'selected':''}}>EUR</option>
                                    <option value="BRL" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="BRL"?'selected':''}}>BRL</option>
                                    <option value="CZK" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="CZK"?'selected':''}}>CZK</option>
                                    <option value="DKK" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="DKK"?'selected':''}}>DKK</option>
                                    <option value="HKD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="HKD"?'selected':''}}>HKD</option>
                                    <option value="HUF" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="HUF"?'selected':''}}>HUF</option>
                                    <option value="ILS" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="ILS"?'selected':''}}>ILS</option>
                                    <option value="JPY" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="JPY"?'selected':''}}>JPY</option>
                                    <option value="MYR" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="MYR"?'selected':''}}>MYR</option>
                                    <option value="MXN" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="MXN"?'selected':''}}>MXN</option>
                                    <option value="NOK" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="NOK"?'selected':''}}>NOK</option>
                                    <option value="NZD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="NZD"?'selected':''}}>NZD</option>
                                    <option value="PHP" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="PHP"?'selected':''}}>PHP</option>
                                    <option value="GBP" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="GBP"?'selected':''}}>GBP</option>
                                    <option value="SGD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="SGD"?'selected':''}}>SGD</option>
                                    <option value="PLN" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="PLN"?'selected':''}}>PLN</option>
                                    <option value="SEK" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="SEK"?'selected':''}}>SEK</option>
                                    <option value="CHF" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="CHF"?'selected':''}}>CHF</option>
                                    <option value="TWD" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="TWD"?'selected':''}}>TWD</option>
                                    <option value="THB" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="THB"?'selected':''}}>THB</option>
                                    <option value="RUB" {{Get_Meta_Tag_Value('Payment_Settings','paypal_currency')=="RUB"?'selected':''}}>RUB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paypal_member_subscription_product_id">PayPal Member Subscription Product ID</label>
                                <input type="text" id="paypal_member_subscription_product_id" name="paypal_member_subscription_product_id" class="@error('paypal_member_subscription_product_id') is-invalid @enderror form-control" placeholder="Enter PayPal Member Subscription Product ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_product_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_member_subscription_plan_id">PayPal Member Subscription Plan ID</label>
                                <input type="text" id="paypal_member_subscription_plan_id" name="paypal_member_subscription_plan_id" class="@error('paypal_member_subscription_plan_id') is-invalid @enderror form-control" placeholder="Enter PayPal Member Subscription Plan ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_plan_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_member_subscription_amount">PayPal Member Subscription Amount</label>
                                <input type="text" id="paypal_member_subscription_amount" name="paypal_member_subscription_amount" class="@error('paypal_member_subscription_amount') is-invalid @enderror form-control" placeholder="Enter PayPal Member Subscription Amount" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_member_subscription_amount')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_member_subscription_product_id">PayPal Family Member Subscription Product ID</label>
                                <input type="text" id="paypal_family_member_subscription_product_id" name="paypal_family_member_subscription_product_id" class="@error('paypal_family_member_subscription_product_id') is-invalid @enderror form-control" placeholder="Enter PayPal Member Subscription Product ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_product_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_member_subscription_plan_id">PayPal Family Member Subscription Plan ID</label>
                                <input type="text" id="paypal_family_member_subscription_plan_id" name="paypal_family_member_subscription_plan_id" class="@error('paypal_family_member_subscription_plan_id') is-invalid @enderror form-control" placeholder="Enter PayPal Member Subscription Plan ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_plan_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_family_member_subscription_amount">PayPal Family Member Subscription Amount</label>
                                <input type="text" id="paypal_family_member_subscription_amount" name="paypal_family_member_subscription_amount" class="@error('paypal_family_member_subscription_amount') is-invalid @enderror form-control" placeholder="Enter PayPal Family Member Subscription Amount" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_family_member_subscription_amount')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_email">Business Email Address</label>
                                <input type="text" id="paypal_email" name="paypal_email" class="@error('paypal_email') is-invalid @enderror form-control" placeholder="Enter business email address" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_email')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_client_id">Client ID</label>
                                <input type="text" id="paypal_client_id" name="paypal_client_id" class="@error('paypal_client_id') is-invalid @enderror form-control" placeholder="Enter Client ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_client_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_client_secret">Client Secret</label>
                                <input type="text" id="paypal_client_secret" name="paypal_client_secret" class="@error('paypal_client_secret') is-invalid @enderror form-control" placeholder="Enter Client Secret" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_client_secret')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_app_id">App ID</label>
                                <input type="text" id="paypal_app_id" name="paypal_app_id" class="@error('paypal_app_id') is-invalid @enderror form-control" placeholder="Enter App ID" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_app_id')}}">
                            </div>
                            <h4>Company Address for Invoices</h4>
                            <div class="form-group">
                                <label for="paypal_address_1">Address 1</label>
                                <input type="text" id="paypal_address_1" name="paypal_address_1" class="@error('paypal_address_1') is-invalid @enderror form-control" placeholder="Enter address 1" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_address_1')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_address_2">Address 2</label>
                                <input type="text" id="paypal_address_2" name="paypal_address_2" class="@error('paypal_address_2') is-invalid @enderror form-control" placeholder="Enter address 2" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_address_2')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_city">City</label>
                                <input type="text" id="paypal_city" name="paypal_city" class="@error('paypal_city') is-invalid @enderror form-control" placeholder="Enter city" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_city')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_state">State</label>
                                <select id="paypal_state" name="paypal_state" class="@error('paypal_state') is-invalid @enderror form-control">
                                    <option value="AB" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'AB' ? 'selected' : ''}}>Alberta</option>
                                    <option value="BC" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'BC' ? 'selected' : ''}}>British Columbia</option>
                                    <option value="MB" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'MB' ? 'selected' : ''}}>Manitoba</option>
                                    <option value="NB" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'NB' ? 'selected' : ''}}>New Brunswick</option>
                                    <option value="NL" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'NL' ? 'selected' : ''}}>Newfoundland and Labrador</option>
                                    <option value="NT" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'NT' ? 'selected' : ''}}>Northwest Territories</option>
                                    <option value="NS" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'NS' ? 'selected' : ''}}>Nova Scotia</option>
                                    <option value="NU" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'NU' ? 'selected' : ''}}>Nunavut</option>
                                    <option value="ON" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'ON' ? 'selected' : ''}}>Ontario</option>
                                    <option value="PE" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'PE' ? 'selected' : ''}}>Prince Edward Island</option>
                                    <option value="QC" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'QC' ? 'selected' : ''}}>Quebec</option>
                                    <option value="SK" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'SK' ? 'selected' : ''}}>Saskatchewan</option>
                                    <option value="YT" {{Get_Meta_Tag_Value('Payment_Settings','paypal_state') == 'YT' ? 'selected' : ''}}>Yukon</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paypal_postal_code">Postal Code</label>
                                <input type="text" id="paypal_postal_code" name="paypal_postal_code" class="@error('paypal_postal_code') is-invalid @enderror form-control" placeholder="Enter postal code" value="{{Get_Meta_Tag_Value('Payment_Settings','paypal_postal_code')}}">
                            </div>
                            <div class="form-group">
                                <label for="paypal_country">Country</label>
                                <select id="paypal_country" name="paypal_country" class="@error('paypal_country') is-invalid @enderror form-control">
                                    <option value="CA" {{Get_Meta_Tag_Value('Payment_Settings','paypal_country')=="CA"?'selected':''}}>Canada</option>
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
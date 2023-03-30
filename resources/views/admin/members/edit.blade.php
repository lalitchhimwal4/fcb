@section('title','Member Details')
@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <h1 class="m-0">Member Details</h1>
    </div>

    <section class="content">
        <div class="">
            @include('admin.error_message')
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach

            <div>
                <table cellpadding="5" class="bg-transparent">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$member->first_name . ' ' . $member->last_name}}</td>
                        </tr>
                        <tr>
                            <th>Policy #</th>
                            <td>{{$member->policy_number}}</td>
                        </tr>
                        <tr>
                            <th>Member #</th>
                            <td>{{$member->member_number}}</td>
                        </tr>
                        <tr>
                            <th>Registration ID</th>
                            <td>{{$member->registration_id}}</td>
                        </tr>
                        <tr>
                            <th>Registration Date</th>
                            <td>{{$member->registration_date}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$insured_profile->email}}</td>
                        </tr>
                        <tr>
                            <th>Telephone</th>
                            <td>{{$insured_profile->telephone}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                {{$insured_profile->address1 . ' - ' . $insured_profile->postal_code}}
                            </td>
                        </tr>
                        <tr>
                            <th>PayPal Details</th>
                            <td>
                                Email: {{$insured_profile->paypal_email}}<br />
                                Subscription ID: {{$insured_profile->paypal_subscription_id}}<br />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($member->isInactive())
            <div class="member-activation-container">
                <div class="activation-note-container">
                    This Primary Insured Member is Inactive.<br />
                    <div class="activation-note-small">
                        <strong>Note:</strong> When an email with payment link is send to the member,
                        they can click the link in the email and resubscribe for automatic billing in PayPal
                        and their account will be activated and they will receive the account activated email.
                        The <strong>Activate Member Without Payment</strong> button will change the Member's account status
                        without sending the reactivation email and without subscribing the Member to PayPal.
                    </div>
                </div>
                <div class="activation-button-container">
                    <a href="{{route('admin.member.activate.email', ['id' => $member->id])}}" class="btn btn-danger">Send Activation Email with Payment Link</a>
                    <a href="{{route('admin.member.activate', ['id' => $member->id])}}" class="btn btn-danger">Activate Member without Payment</a>
                </div>
            </div>
            @endif

            <div class="card-body table-responsive">
                <p>Below are the member accounts associated with the Primary Insured Profile:</p>
                <table id="customboxeslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Member #</th>
                            <th>Name</th>
                            <th>Relationship</th>
                            <th>Account Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member->familyMembers() as $family_member)
                        <tr>
                            <td>{{$family_member->member_number}}</td>
                            <td>{{$family_member->first_name . ' ' . $family_member->last_name}}</td>
                            <td>{{($member_relationships != 0 && isset($member_relationships[$family_member->relationship])) ? $member_relationships[$family_member->relationship] : $family_member->relationship}}</td>
                            <td>{{($account_statuses != 0 && isset($account_statuses[$family_member->account_status])) ? $account_statuses[$family_member->account_status] : $family_member->account_status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(count($payments))
            <div>
                <p>Below are the payment details associated with the account:</p>
                <table id="customboxeslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Payment Token</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->payment_token}}</td>
                            <td>{{$payment->payment_method}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->payment_time}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
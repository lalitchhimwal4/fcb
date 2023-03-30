<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\EmailTrait;
use App\Models\SaveMemberDetails;
use Exception;
use Illuminate\Support\Facades\Redirect;

class SaveMemberController extends Controller
{
    use EmailTrait;

    public function SaveMemberDetails(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'unique:save_member_details', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
        ]);

        SaveMemberDetails::create(array_merge($request->all()));
        $name = $request->firstname.' '.$request->lastname;
        $send_data = array('name' => $name, 'email' => $request->email, 'subject' => "FCB HealthNetwork");
        $Usertemplate = "<p>Hello $name</p>
        <p>Thank you for showing interest in the Covid 19 Health and Dental Relief Plan.</p>
        <p>You have been added to our mailing list and we will be circling back when enrollment is live.</p>
        <p>We look forward to having you join.</p>
        <p>Thank You</p>
        <p>FCB Health Network</p>";
        //$Usertemplate =  "Hello $name, Thank you for showing interest in the Covid 19 Health and Dental Relief Plan. You have been added to our mailing list and we will be circling back when enrollment is live. We look forward to having you join.";
        $Usertemplate = array('body' => $Usertemplate);
        $data = array_merge($send_data, ['template' => $Usertemplate]);
        
        //  Send mail to user
        try {
            Mail::send('emails/member/save-member', ['template' => $Usertemplate], function ($message) use ($request, $Usertemplate){
                $message;
                $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                $message->to($request->email)->subject('FCB HealthNetwork');
            });
        } catch (Exception $e) {
            return Redirect::route('member.enroll.step1')->with('error', 'Something went wrong in trying to contact us. Email can not be send.');
        }

        return Redirect::route('member.enroll.step1')->withSuccess('Email Sent Successfully');
    }

    public function SavePayorDetails(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
        ]);

        //SaveMemberDetails::create(array_merge($request->all()));
        $name = $request->name;
        $send_data = array('name' => $name, 'email' => $request->email, 'subject' => "FCB HealthNetwork");
        $Usertemplate = "<p>Hello Admin Payor Lead</p>
        <p>Company Name - $request->company_name</p>
        <p>Name - $request->name</p>
        <p>Email ID - $request->email</p>
        <p>Phone - $request->phone</p>
        <p>Message - $request->message</p>
        
        <p>FCB Health Network</p>";
        $Usertemplate = array('body' => $Usertemplate);
        $data = array_merge($send_data, ['template' => $Usertemplate]);
        
        //  Send mail to user
        try {
            Mail::send('emails/member/save-member', ['template' => $Usertemplate], function ($message) use ($request, $Usertemplate){
                $message;
                $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                $message->to('solutions@fcbhealthnetwork.ca')->subject('FCB HealthNetwork');
            });
        } catch (Exception $e) {
            return 'Something went wrong in trying to contact us. Email can not be send.';
        }

        return 'Email Sent Successfully';
    }
}

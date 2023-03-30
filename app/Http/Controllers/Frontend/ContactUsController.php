<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\EmailTrait;
use App\Models\ContactDetails;
use Exception;
use Illuminate\Support\Facades\Redirect;

class ContactUsController extends Controller
{
    use EmailTrait;

    public function index()
    {
        return view('frontend.contact-us');
    }

    public function SaveContactDetails(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'subject' => ['required', 'min:3', 'max:30'],
            'message' => ['required', 'min:3', 'max:1000'],
        ]);

        ContactDetails::create(array_merge($request->all(), ['info_type' => 'ContactUs']));

        $send_data = array('name' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'messagecontent' => $request->message);

        $Admintemplate =  $this->FindTemplate('contact-us-admin');
        $Usertemplate =  $this->FindTemplate('contact-us-user');

        try {
            //  Send mail to admin
            Mail::send('emails/email', array_merge($send_data, ['template' => $Admintemplate]), function ($message) use ($request, $Admintemplate) {
                // $message->from($request->email, $request->name);
                $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                $message->to(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'))->subject($Admintemplate->subject);
            });

            //  Send mail to user
            Mail::send('emails/email', array_merge($send_data, ['template' => $Usertemplate]), function ($message) use ($request, $Usertemplate) {
                $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                $message->to($request->email)->subject($Usertemplate->subject);
            });
        } catch (Exception $e) {
            return Redirect::route('ContactUs')->with('error', 'Something went wrong in trying to contact us. Email can not be send.');
        }

        return Redirect::route('ContactUs')->withSuccess('Email Sent Successfully');
    }
}

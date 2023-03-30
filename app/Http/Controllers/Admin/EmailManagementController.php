<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\EmailTemplate;
use Illuminate\Support\Facades\Redirect;

class EmailManagementController extends Controller
{
    #----------------------------------------------------------------------------------------------------
    #    index
    #----------------------------------------------------------------------------------------------------

    public function index()
    {
        $emails = EmailTemplate::all();
        return view('admin.emails.index')->with(['title' => 'Email Management', 'emails' => $emails]);
    }

    #----------------------------------------------------------------------------------------------------
    #    index
    #----------------------------------------------------------------------------------------------------
    public function edit($slug)
    {
        $emails = EmailTemplate::where('slug', $slug)->first();
        return view('admin.emails.edit')->with(['title' => 'Email Management', 'email' => $emails]);
    }

    #----------------------------------------------------------------------------------------------------
    #    index
    #----------------------------------------------------------------------------------------------------
    public function create(Request $request)
    {
        $e = new EmailTemplate;
        $e->title = trim($request->title);
        $e->save();
        return Redirect::route('admin.emails.index')->with('flash_message', 'Email Template is saved Successfully');
    }

    #----------------------------------------------------------------------------------------------------
    #    index
    #----------------------------------------------------------------------------------------------------
    public function update(Request $request, $slug)
    {
        $email = EmailTemplate::where('slug', $slug)->first();
        $email->update($request->all());
        return Redirect::route('admin.emails.index')->with('flash_message', 'Email Template has been updated Successfully');
    }
}

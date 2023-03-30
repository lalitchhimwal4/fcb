<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accordian;
use Illuminate\Support\Facades\Redirect;

class AccordianController extends Controller
{
    //Accordians
    public function Accordians()
    {
        return view('admin.Accordians.accordians', ['accordians' => Accordian::all()]);
    }

    public function AddAccordian()
    {
        return view('admin.Accordians.add-accordian');
    }

    public function SaveAccordian(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:500',
        ]);

        Accordian::create($request->all());

        return Redirect::route('admin.Accordians')->withSuccess('Accordian Added');
    }

    public function DeleteAccordian($id = NULL)
    {
        Accordian::where('id', $id)->delete();
        return Redirect::route('admin.Accordians')->withSuccess('Accordian Deleted');
    }

    public function EditAccordian($id = NULL)
    {
        return view('admin.Accordians.edit-accordian', ['accordian' => Accordian::find($id)]);
    }

    public function UpdateAccordian(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:500',
        ]);

        $accordian = Accordian::find($id);
        $accordian->update($request->all());

        return Redirect::route('admin.Accordians')->withSuccess('Accordian Updated');
    }
}

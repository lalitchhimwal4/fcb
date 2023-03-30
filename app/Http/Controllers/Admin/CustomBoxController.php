<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomBox;
use Illuminate\Support\Facades\Redirect;

class CustomBoxController extends Controller
{
    //custom boxes
    public function CustomBoxes()
    {
        return view('admin.CustomBoxes.custom-boxes', ['customboxes' => CustomBox::all()]);
    }

    public function AddCustomBox()
    {
        return view('admin.CustomBoxes.add-custom-box');
    }

    public function SaveCustomBox(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'Image' => 'required|image|max:2048|mimes:jpeg,png,jpg,svg',
        ]);

        $custombox = new CustomBox;
        $custombox->type = $request->Type;
        $custombox->title = $request->title;
        $custombox->description = $request->Description;
        $custombox->button_text = $request->Button_Text;
        $custombox->button_link = $request->Button_Link;
        $custombox->status = $request->Status;
        $custombox->image = single_image_upload($request->Image, 'CustomBox');

        $custombox->save();
        return Redirect::route('admin.CustomBoxes')->withSuccess('Custom Box Added');
    }

    public function DeleteCustomBox($id = NULL)
    {
        CustomBox::where('id', $id)->delete();
        return Redirect::route('admin.CustomBoxes')->withSuccess('Custom Box Deleted');
    }

    public function EditCustomBox($id = NULL)
    {
        return view('admin.CustomBoxes.edit-custom-box', ['custombox' => CustomBox::find($id)]);
    }

    public function UpdateCustomBox(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'Image' => 'image|max:2048|mimes:jpeg,png,jpg,svg',
        ]);

        $custombox =  CustomBox::find($id);
        $custombox->type = $request->Type;
        $custombox->title = $request->title;
        $custombox->description = $request->Description;
        $custombox->button_text = $request->Button_Text;
        $custombox->button_link = $request->Button_Link;
        $custombox->status = $request->Status;
        if (!empty($request->Image)) {
            $file_path = public_path('/storage/' . $custombox->image);
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
            $custombox->image = single_image_upload($request->Image, 'CustomBox');
        }

        $custombox->save();
        return Redirect::route('admin.CustomBoxes')->withSuccess('Custom Box Updated');
    }
}

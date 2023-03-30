<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsPublication;
use Illuminate\Support\Facades\Redirect;

class NewsPublicationsController extends Controller
{
  //Cms Pages
  public function NewsPublications()
  {
    return view('admin.NewsPublications.index', ['news_publications' => NewsPublication::all()]);
  }

  public function Add_News_Publications()
  {
    return view('admin.NewsPublications.add');
  }

  public function Save_News_Publications(Request $request)
  {
    $request->validate([
      'title' => 'required|min:3|max:50',
      'Status' => 'required',
      'Type' => 'required',
      'Short_Description' => 'required',
      'Full_Description' => 'required',
    ]);

    NewsPublication::create($request->all());
    return Redirect::route('admin.NewsPublications')->withSuccess('Record Successfully  Added');
  }

  public function Edit_News_Publications($id = null)
  {
    return view('admin.NewsPublications.edit', ['news_publication' => NewsPublication::find($id)]);
  }

  public function Update_News_Publications(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|min:3|max:50',
      'Status' => 'required',
      'Type' => 'required',
      'Short_Description' => 'required',
      'Full_Description' => 'required',
    ]);

    $NewsPublication = NewsPublication::find($id);
    $NewsPublication->update($request->all());

    return Redirect::route('admin.NewsPublications')->withSuccess('Record Successfully updated');
  }

  public function Delete_News_Publications($id = null)
  {
    $res = NewsPublication::where('id', $id)->delete();
    if ($res) {
      return Redirect::route('admin.NewsPublications')->withSuccess('Record Successfully Deleted');
    }
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Redirect;

class CmsController extends Controller
{
  //Cms Pages
  public function CmsPages()
  {
    return view('admin.cmspages.index', ['cmspages' => CmsPage::all()]);
  }

  public function AddCmsPage()
  {
    return view('admin.cmspages.add');
  }

  public function SaveCmsPage(Request $request)
  {
    $request->validate([
      'Title' => 'required|min:3|max:50',
      'Status' => 'required',
    ]);

    CmsPage::create($request->all());
    return Redirect::route('admin.CmsPages')->withSuccess('Cms Page Added');
  }


  public function EditCmspage($id = null)
  {
    return view('admin.cmspages.edit', ['cmspage' => CmsPage::find($id)]);
  }

  public function UpdateCmsPage(Request $request, $id)
  {
    $request->validate([
      'Title' => 'required|min:3|max:50',
      'Status' => 'required',
    ]);

    $cmspage = CmsPage::find($id);
    $cmspage->update($request->all());

    return Redirect::route('admin.CmsPages')->withSuccess('Cms Page updated');
  }


  public function DeleteCmspage($id = null)
  {
    $res = Cmspage::where('id', $id)->delete();
    if ($res) {
      return Redirect::route('admin.CmsPages')->withSuccess('Cms Page Successfully Deleted');
    }
  }
}

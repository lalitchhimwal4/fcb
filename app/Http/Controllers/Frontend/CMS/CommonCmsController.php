<?php

namespace App\Http\Controllers\Frontend\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CommonCmsController extends Controller
{
  public function index($slug = '')
  {
    $cmspage = CmsPage::where('slug', '=', $slug)->where('status', '=', 1)->firstOrFail();
    return view('frontend.CMS.commonview', ['cmspage' => $cmspage]);
  }
}

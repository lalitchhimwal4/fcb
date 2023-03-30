<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsPublication;

class PublicationsController extends Controller
{
   public function PublicationsListing()
   {
      return view('frontend.publications', ['publications' => NewsPublication::where('type', 2)->get()]);
   }

   public function PublicationsDetail($slug = NULL)
   {
      $publication = NewsPublication::where('slug', $slug)->where('type', 2)->firstOrFail();
      $previous = NewsPublication::where('id', '<', $publication->id)->where('type', 2)->orderBy('id', 'desc')->first();
      $next =  NewsPublication::where('id', '>', $publication->id)->where('type', 2)->orderBy('id', 'asc')->first();
      return view('frontend.publicationsdetail', compact('publication', 'previous', 'next'));
   }
}

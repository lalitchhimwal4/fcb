<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsPublication;

class NewsController extends Controller
{
	public function NewsListing()
	{
		return view('frontend.news', ['news' => NewsPublication::where('type', 1)->get()]);
	}

	public function NewsDetail($slug = NULL)
	{
		$news = NewsPublication::where('slug', $slug)->where('type', 1)->firstOrFail();
		$previous = NewsPublication::where('id', '<', $news->id)->where('type', 1)->orderBy('id', 'desc')->first();
		$next =  NewsPublication::where('id', '>', $news->id)->where('type', 1)->orderBy('id', 'asc')->first();
		return view('frontend.newsdetail', compact('news', 'previous', 'next'));
	}
}

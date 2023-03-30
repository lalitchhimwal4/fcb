@section('title',$cmspage->title)
@section('metatitle',$cmspage->meta_title)
@section('metakeyword',$cmspage->meta_keyword)
@section('metadescription',$cmspage->meta_description)
@extends('layouts.frontend.main')
@section('content')

<section class="news cm-top-mrgn" id="news">
    <div class="counters news-sec">
        <div class="container">
            <ul>
                <li>
                    <h2>{{$cmspage->title}}</h2>
                    <span>{{$cmspage->subtitle}}</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{!! $cmspage->description !!}

@endsection
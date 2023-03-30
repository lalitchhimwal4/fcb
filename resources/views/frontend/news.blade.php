@section('title','News')
@section('metatitle',Get_Meta_Tag_Value('News_Settings','Meta_Title'))   
@section('metakeyword',Get_Meta_Tag_Value('News_Settings','Meta_Keyword'))   
@section('metadescription',Get_Meta_Tag_Value('News_Settings','Meta_Description'))  
@extends('layouts.frontend.main')
@section('content')


    <!-- NEWS-SEC START -->
    <section class="news cm-top-mrgn" id="news">
        <div class="counters news-sec">
            <div class="container">
                <ul>
                    <li>
                        <h2>{{(Get_Meta_Tag_Value('News_Settings','Heading1'))?Get_Meta_Tag_Value('News_Settings','Heading1'):'News'}}</h2>
                        <span>{{(Get_Meta_Tag_Value('News_Settings','Heading2'))?Get_Meta_Tag_Value('News_Settings','Heading2'):'The latest member news & information from our network'}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- NEWS-SEC END -->

    <section class="video" style="margin:20px 0;">
        <div class="container text-center">
            <video autoplay controls>
                <source src="{{asset('/frontend_assets/images/First Canadian Benefits.mp4');}}" type="video/mp4">
            </video> 
        </div>
    </section>

    <!-- INSURANCE-SEC START -->
    <section class="insurance-sec" id="insurance-sec">
        <div class="container">
            <div class="insurance-trends">
                @foreach($news as $singlenews)
                <div class="trends-content">
                    <h2>
                        <a href="{{'news/'.$singlenews->slug}}" class="trends">{{$singlenews->title}}</a>
                    </h2>
                    <p>{{$singlenews->short_description}}</p>
                    <div class="date-year">
                        <span class="date-year-value">{{date_format($singlenews->created_at,'M d, Y')}} <b style="margin-left:20px;">{{$singlenews->published}}</b></span>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- INSURANCE END -->
    
   
@endsection

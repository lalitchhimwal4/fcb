@section('title','Publications')
@section('metatitle',Get_Meta_Tag_Value('Publications_Settings','Meta_Title'))   
@section('metakeyword',Get_Meta_Tag_Value('Publications_Settings','Meta_Keyword'))   
@section('metadescription',Get_Meta_Tag_Value('Publications_Settings','Meta_Description'))  
@extends('layouts.frontend.main')
@section('content')


    <!-- PUBLICATION START -->
    <section class="news publication cm-top-mrgn" id="publication">
        <div class="counters news-sec">
            <div class="container">
                <ul>
                    <li>
                        <h2>{{(Get_Meta_Tag_Value('Publications_Settings','Heading1'))?Get_Meta_Tag_Value('Publications_Settings','Heading1'):'Publications'}}</h2>
                          <span>{{(Get_Meta_Tag_Value('Publications_Settings','Heading2'))?Get_Meta_Tag_Value('Publications_Settings','Heading2'):' '}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- PUBLICATION END -->

    <!-- INSURANCE-TREND-QSTN START -->
    <div class="insurance-trend-qstn" id="insurance-trend-qstn">
        <div class="container">
            <div class="row">
                 @foreach($publications as $publication)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="ins-trend">
                        <h2><a href="{{'publications/'.$publication->slug}}" class="heading-two">{{$publication->title}}</a></h2>
                        <span>{{date_format($publication->created_at,'M d, Y')}}</span>
                        <p>{{$publication->short_description}}</p>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
    <!-- INSURANCE-TREND-QSTN END -->

    
    
   
@endsection

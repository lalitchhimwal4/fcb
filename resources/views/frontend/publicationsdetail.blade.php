@section('title','Publications Detail')
@extends('layouts.frontend.main')
@section('content')


    <!-- publication-SEC START -->
   <section class="news cm-top-mrgn" id="news">
       <div class="counters news-sec news-sec-inner">
            <div class="container">
                <ul>
                    <li>
                        <h2>{{$publication->title}}</h2>
                        <!-- <div class="links">
                            <a href="http://49.249.236.30:78/larry/index.html" class="nav-link">Home</a>/
                            <a href="http://49.249.236.30:78/larry/publications.html" class="nav-link">Publications</a>/
                            <a href="http://49.249.236.30:78/larry/insurance-trends.html" class="nav-link">Insurance Trends Article</a>
                        </div> -->
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- publication-SEC END -->

    <!-- HEATH-AND-DENTAL START  -->
    <section class="health-and-dental" id="health-and-dental">
        <div class="container">
             <!-- Previous Next links -->

        @if($previous || $next)
        <span class="date-year-value">
        @endif  

          @if($previous)  <a href="{{$previous->slug}}" class="new-back"><i class="fas fa-chevron-left"></i> Previous</a> @endif
          @if($next)      <a href="{{$next->slug}}" class="new-back">Next<i class="fas fa-chevron-right"></i> </a>  @endif


        @if($previous || $next)   
        </span>
        @endif
         
         <!-- Previous Next links complete -->

            <div class="ontario-health">
                 {!!$publication->full_description!!}
                <div class="date-year">
                    <span class="date-year-value">{{date_format($publication->created_at,'M d, Y')}}</span>
                </div>

                <div class="share-story">
                    <h4>Share This Story, Choose Your Platform!</h4>
                    <ul class="story-icons">
                        <li>
                            <a href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Ffirstcanadianbenefits.pmdms.com%2Fpublications%2Finsurance-trends%2F&amp;t=Insurance%20Trends%20Article" target="_blank"   data-toggle="tooltip" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Reddit">
                                <i class="fab fa-reddit-alien"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Tumblr">
                                <i class="fab fa-tumblr"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Pinterest">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Vk">
                                <i class="fab fa-vk"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Xing">
                                <i class="fab fa-xing"></i>
                            </a>
                            <a href="javascript:void(0);"  data-toggle="tooltip" title="Email">
                                <i class="far fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="related-post">
                    <h3>Related Posts</h3>
                    <a href="javascript:void(0);" class="post-box-ref"></a>
                    <span>Leave A Comment </span>
                    <p class="must-log-in">You must be <a href="javascript:void(0);">logged in</a> to post a comment.</p>
                </div>
            </div>
        </div>
    </section>
   

    
   
@endsection

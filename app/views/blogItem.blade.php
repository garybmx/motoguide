@extends('layouts.base')
@section('title')
<title>{{trans('blogItem.title')}} {{$blogArray['header']}}</title>
<meta name="description" content="{{trans('blogItem.description')}} {{$blogArray['header']}}" />
<meta name="keywords" content="{{$blogArray['tags']}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop
@section('body')
<div class="breadcrumbs margin-bottom-40">
     <div class="container">
        <h1 class="color-orange pull-left back">
            @if(URL::previous() == url())
            <a href="{{ URL::to(Config::get('app.locale') . '/blog')}}">
                @elseif(HTML::prevPage() == true)
                <a href="{{ URL::to(Config::get('app.locale') . '/blog')}}">
                @else
                <a href="{{ URL::previous()}}">
                    @endif
                    <i class="icon-angle-left"></i> {{trans('blogItem.header')}}</a></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale') . '/')}}">{{trans('blogItem.menu1')}}</a> <span class="divider">/</span></li>
            <li><a href="{{ URL::to(Config::get('app.locale') . '/blog')}}">{{trans('blogItem.menu2')}}</a> <span class="divider">/</span></li>
            <li class="active ">{{trans('blogItem.menu3')}}</li>
        </ul>
    </div><!--/container-->
</div>

<!--=== Blog Posts ===-->
<div class="container content-sm">
    <div class="row">
        <div class="col-md-9">
                    <!-- News v3 -->
                    <div class="news-v3 bg-color-white margin-bottom-30">
                        {{ HTML::image('images/blog/blog_'.$blogArray['id'].'.jpeg', trans('blogItem.pic') . $blogArray['header'], array('class' => 'img-responsive full-width padding-right-15')) }}
                        
                        <div class="news-v3-in">
                             <h2>{{$blogArray['header']}}</h2>
                            <ul class="list-inline posted-info">
                                <li>{{$blogArray['month']}} {{(int)$blogArray['day']}}, {{$blogArray['year']}}</li>
                            </ul>
                             <p class="description">
                            {{$blogArray['text']}}
                             </p>
                         
                        </div>
                    </div>                        
                    <!-- End News v3 -->

                   

                 
               
                  
               
                </div>

        <div class="col-md-3">

              @if(!empty($pastArray))
            <!-- Blog Thumb v2 -->
            <div class="margin-bottom-50">
                <h2 class="title-v4">{{trans('blogItem.pastTours')}}</h2>

                  @foreach($pastArray as $pastTour)
                <div class="blog-thumb blog-thumb-circle margin-bottom-15">
                    <div class="blog-thumb-hover">
                        {{ HTML::image('images/tours/tour_'.$pastTour['tour_id'].'/enduroTour1.jpeg', trans('blogItem.pastPic')  . $pastTour['name'] , array('class' => 'rounded-x')) }}
                     
                        <a class="hover-grad" href="{{ URL::to(Config::get('app.locale')  . '/pastTours/' . $pastTour['tour_id'])}}"><i class="icon-search"></i></a>
                    </div>
                    <div class="blog-thumb-desc">
                        <h3><a href="{{ URL::to(Config::get('app.locale')  . '/pastTours/' . $pastTour['tour_id'])}}">{{$pastTour['name']}}</a></h3>
                        <ul class="blog-thumb-info">
                            <li>{{date("d-m-Y", strtotime($pastTour['startTime']));}}</li>                           
                        </ul>
                    </div>
                </div>
                @endforeach
               
            </div>
            @endif
            <!-- End Blog Thumb v3 -->
            @if(!empty($futureArray))
            <div class="margin-bottom-50">
                <h2 class="title-v4">{{trans('blogItem.futureTours')}}</h2>
                
                @foreach($futureArray as $futureTour)
                <div class="blog-thumb blog-thumb-circle margin-bottom-15">
                    <div class="blog-thumb-hover">
                        {{ HTML::image('images/tours/tour_'.$futureTour['tour_id'].'/enduroTour1.jpeg',trans('blogItem.futurePic')  . $futureTour['name'], array('class' => 'rounded-x')) }}
                     
                        <a class="hover-grad" href="{{ URL::to(Config::get('app.locale')  . '/futureTours/' . $futureTour['tour_id'])}}"><i class="icon-search"></i></a>
                    </div>
                    <div class="blog-thumb-desc">
                        <h3><a href="{{ URL::to(Config::get('app.locale')  . '/futureTours/' . $futureTour['tour_id'])}}">{{$futureTour['name']}}</a></h3>
                        <ul class="blog-thumb-info">
                            <li> @if($futureTour['nodateactive'] == 1)
                                @if($futureTour['nodate'] == '')
                                -----
                                @else
                                {{$futureTour['nodate']}}
                                @endif
                                @else
                                 {{date("d-m-Y", strtotime($futureTour['startTime']));}}
                                @endif
                           </li>                           
                        </ul>
                    </div>
                </div>
                @endforeach
          
          

              
            </div>
        @endif
            <!-- End Blog Thumb v2 -->
        </div>
    </div><!--/end row-->
</div>


<!--=== End Blog Posts ===-->
@stop
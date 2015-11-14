@extends('layouts.base')
@section('title')
<title>{{trans('blog.title')}}</title>
<meta name="description" content="{{trans('blog.description')}}" />
<meta name="keywords" content="{{trans('blog.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop

@section('body')
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('blog.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('blog.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('blog.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div>

<!--=== Blog Posts ===-->
<div class="container content-sm">
    <div class="row">
        <div class="col-md-9 md-margin-bottom-50">


            <!-- Blog Grid -->

            <div class="row news-v2 margin-bottom-50">
                @if(!empty($blogArray['items']))
                @foreach($blogArray['items'] as $blog)
                <div class="row margin-bottom-30">
                    <div class="col-sm-4 sm-margin-bottom-20">
                        {{ HTML::image('images/blog/blog_'.$blog['id'].'.jpeg', trans('blog.pic') . $blog['header'], array('class' => 'img-responsive', 'title' => trans('blog.pic') . $blog['header'])) }}
                    </div>
                    <div class="col-sm-8">
                        <div class="blog-grid">
                            <h3><a href="{{ URL::to(Config::get('app.locale')  . '/blog/' . $blog['id'])}}">{{$blog['header']}}</a></h3>
                            <ul class="blog-grid-info">

                                <li>{{$blog['month']}} {{(int)$blog['day']}}, {{$blog['year']}}</li>

                            </ul>
                            <p>{{$blog['text']}}</p>
                            <a class="r-more" href="{{ URL::to(Config::get('app.locale')  . '/blog/' . $blog['id'])}}">{{trans('blog.readmore')}}</a>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach 
                @else
                <h2>{{trans('blog.noblog')}}</h2>
                @endif
            </div>



           

            <!-- End Blog Grid -->
{{$blogArray['links']}}

           				
        </div>

        <div class="col-md-3">

           @if(!empty($pastArray))
            <!-- Blog Thumb v2 -->
            <div class="margin-bottom-50">
                <h2 class="title-v4">{{trans('blog.past')}}</h2>

                  @foreach($pastArray as $pastTour)
                <div class="blog-thumb blog-thumb-circle margin-bottom-15">
                    <div class="blog-thumb-hover">
                        {{ HTML::image('images/tours/tour_'.$pastTour['tour_id'].'/enduroTour1.jpeg',trans('blog.futurePic')  . $pastTour['name'], array('class' => 'rounded-x')) }}
                     
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
                <h2 class="title-v4">{{trans('blog.future')}}</h2>
                
                @foreach($futureArray as $futureTour)
                <div class="blog-thumb blog-thumb-circle margin-bottom-15">
                    <div class="blog-thumb-hover">
                        {{ HTML::image('images/tours/tour_'.$futureTour['tour_id'].'/enduroTour1.jpeg', trans('blog.futurePic')  . $futureTour['name'], array('class' => 'rounded-x')) }}
                     
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
                                @endif</li>                           
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
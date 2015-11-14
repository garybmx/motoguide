@extends('layouts.base')
@section('title')
<title>{{trans('futureTours.title')}}</title>
<meta name="description" content="{{trans('futureTours.description')}}" />
<meta name="keywords" content="{{trans('futureTours.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop

@section('body')

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('futureTours.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('futureTours.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('futureTours.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container content-md">



@if(!empty($futureTourArray['items']))
 @foreach($futureTourArray['items'] as $tour)
    <!-- News v3 -->
    <div class="row margin-bottom-20">
        <div class="col-md-5 sm-margin-bottom-20">
           
                {{ HTML::image('images/tours/tour_'.$tour['tour_id'].'/enduroTour1.jpeg',  trans('futureTours.tour2'). $tour['name'], array('class' => 'img-responsive')) }}
        </div>
        <div class="col-md-7">
            <div class="news-v3">
                <h2><a href="{{ URL::to(Config::get('app.locale') . '/futureTours/' . $tour['tour_id'])}}">{{trans('futureTours.tour')}} "{{$tour['name']}}"</a></h2>
                <ul class="unstyled biglist">
                    <li><i class="icon-calendar color-orange"  title="{{trans('futureTours.time')}}"></i> 
                        @if($tour['nodateactive'] == 1)
                        @if($tour['nodate'] == '')
                        -----
                        @else
                        {{$tour['nodate']}}
                        @endif
                        @else
                        {{date("j.m.Y", strtotime($tour['startTime']));}} - {{date("j.m.Y", strtotime($tour['endTime']));}}
                        @endif</li>
                    <li><i class="icon-map-marker color-orange" title="{{trans('futureTours.place')}}"></i> {{$tour['location']}}</li>
                    <li><i class="icon-signal color-orange"  title="{{trans('futureTours.level')}}"></i> {{$tour['level']}}</li>
                </ul>

                <p>{{$tour['description']}}</p>
                <a href="{{ URL::to(Config::get('app.locale') . '/futureTours/' . $tour['tour_id'])}}">
                     
                    <button class="btn-u btn-brd btn-brd-hover btn-u-orange" onclick="location.href='{{ URL::to(Config::get('app.locale') . '/futureTours/' . $tour['tour_id'])}}'" type="button">{{trans('futureTours.readmore')}}</button>
                      
                    
                </a>
              
            </div>
        </div>          


    </div><!--/end row-->
     <div class="clearfix margin-bottom-20"><hr></div>
    @endforeach
    @else
    <h2>
        {{trans('futureTours.notours')}}
        </h2>
    @endif
   

    <!-- Pager v3 -->
  {{$futureTourArray['links']}}
    <!-- End Pager v3 -->
</div><!--/end container-->
<!--=== End Content Part ===-->
@stop


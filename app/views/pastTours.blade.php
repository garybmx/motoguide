@extends('layouts.base')
@section('title')
<title>{{trans('pastTours.title')}}</title>
<meta name="description" content="{{trans('pastTours.description')}}" />
<meta name="keywords" content="{{trans('pastTours.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop

@section('body')

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('pastTours.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('pastTours.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('pastTours.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->


<!--=== Content Part ===-->

<div class="container portfolio-columns"> 	    
    @if(!empty($toursArray['items']))
    <div class="row"> 
        
        @foreach($toursArray['items'] as $tour)
        <div class="view view-tenth col-md-6">
        {{ HTML::image('images/tours/tour_'.$tour['tour_id'].'/enduroTour1.jpeg', trans('pastTours.tour'). $tour['name']) }}	
        
            <div class="mask">
                <h2>{{$tour['name']}}</h2>
                <p>  @if($tour['nodateactive'] == 1)
                        @if($tour['nodate'] == '')
                        -----
                        @else
                        {{$tour['nodate']}}
                        @endif
                        @else
                        {{date("j.m.Y", strtotime($tour['startTime']));}} - {{date("j.m.Y", strtotime($tour['endTime']));}}
                        @endif</p>
                <a href="{{ URL::to(Config::get('app.locale')  . '/pastTours/'.$tour['tour_id']) }}" class="info">{{trans('pastTours.readmore')}}</a>
            </div>
        </div>
        @endforeach
        
    </div><!--/row-fluid-->
    @else
    <h1>{{trans('pastTours.notours')}}</h1>
    @endif
     {{$toursArray['links']}} 
</div><!--/container-->
<!--=== End Content Part ===-->
@stop
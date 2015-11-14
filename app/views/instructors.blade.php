@extends('layouts.base')
@section('title')
<title>{{trans('about.title')}}</title>
<meta name="description" content="{{trans('about.description')}}" />
<meta name="keywords" content="{{trans('about.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop
@section('body')

<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">{{trans('about.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('about.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('about.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container">		
    <div class="row-fluid margin-bottom-30">
        <div class="span6">
            {{$informationArray['about_1']}}

        </div>
        <div class="span6">
            <iframe src="http://player.vimeo.com/video/9679622" width="100%" height="327" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> 
        </div>
    </div><!--/row-fluid-->

    <!-- Meer Our Team -->
    @if(!empty($instructorArray))        
    <div class="headline"><h3>{{trans('about.team')}}</h3></div>
    
    <ul class="thumbnails team">
        @foreach($instructorArray as $instructor)
        <li class="span3">
            <div class="thumbnail-style">
                {{ HTML::image('images/instructors/instructor_'.$instructor['id'].'.jpeg', trans('about.picture'). ' '. $instructor['name'] . ' ' . $instructor['lastname']) }}

                <h3><a>{{$instructor['name']}} {{$instructor['lastname']}}</a>
                    @if($instructor['age'] != '0')
                    <small>{{trans('about.age')}}: {{$instructor['age']}}</small>
                    @endif
                </h3>
                <p>{{$instructor['expirience']}}</p>               
            </div>
        </li>
        @endforeach
       
    </ul><!--/thumbnails-->
    <!-- //End Meer Our Team -->
    @endif

    <!-- //End Our Clients -->
</div><!--/container-->		
@stop
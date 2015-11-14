@extends('layouts.base')

@section('title')
<title>{{trans('futureItem.title')}} {{$tourArray['name']}}</title>
<meta name="description" content="{{trans('futureItem.description')}} {{$tourArray['name']}}" />
<meta name="keywords" content="{{trans('futureItem.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop

@section('headercss')

{{HTML::style('assets/plugins/bxslider/jquery.bxslider.css')}}

@stop
@section('body')


<!--=== Breadcrumbs ===-->
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-orange pull-left back">
            
            @if(URL::previous() == url())
            <a href="{{ URL::to(Config::get('app.locale') . '/futureTours')}}">
                @elseif(HTML::prevPage() == true)
                <a href="{{ URL::to(Config::get('app.locale') . '/futureTours')}}">
                @else
                <a href="{{ URL::previous()}}">
                    @endif
                    <i class="icon-angle-left"></i> {{trans('futureItem.header')}}</a></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale') . '/')}}">{{trans('futureItem.menu1')}}</a> <span class="divider">/</span></li>
            <li><a href="{{ URL::to(Config::get('app.locale') . '/futureTours')}}">{{trans('futureItem.menu2')}}</a> <span class="divider">/</span></li>
            <li class="active ">{{trans('futureItem.menu3')}}</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container portfolio-item"> 	
    <div class="row-fluid margin-bottom-20"> 
        <!-- Carousel -->
        <div class="col-md-6">
            @if(count($fileArray) > 0)
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                    @for($i = 0; $i<count($fileArray);$i++)
                        @if($i==0)
                        <div class="item active">
                            @else    
                            <div class="item">
                                @endif
                                {{ HTML::image('images/tours/tour_'.$tourArray['tour_id'].'/'.$fileArray[$i], 'Bulgaria Enduro tour ' . $tourArray['name'], array('title' => 'Bulgaria Enduro tour ' . $tourArray['name'])) }}
                            </div>

                            @endfor
                        </div>
                        @if(count($fileArray)>1)
                        <div class="carousel-arrow">
                            <a data-slide="prev" href="#myCarousel" class="left carousel-control"><i class="icon-angle-left"></i></a>
                            <a data-slide="next" href="#myCarousel" class="right carousel-control"><i class="icon-angle-right"></i></a>
                        </div>
                        @endif
                </div>
                @endif    
                <div class="pricing">
                    <div class="pricing-head">
                        <a href="{{ URL::to(Config::get('app.locale') . '/request?request='.$tourArray['tour_id'])}}" class="pricing-link"><h3>Записаться на тур<span>Морское побережье</span></h3> </a>
                        <h4><i>&#8364;</i>{{$priceArray[1]['price']}} / <i>{{$tourArray['duration']}}</i></h4>
                    </div>

                    <div class="pricing-content">

                        {{$priceArray[1]['description']}}

                    </div>

                </div>

            </div><!--/span7-->
            <!-- //End Tabs and Carousel -->

            <div class="col-md-6">
                <h2>{{$tourArray['name']}}</h2>
                <p></p>
                <ul class="unstyled biglist">
                    <li><i class="icon-calendar color-orange"  title="Время проведения тура"></i>
                        @if($tourArray['nodateactive'] == 1)
                        @if($tourArray['nodate'] == '')
                        -----
                        @else
                        {{$tourArray['nodate']}}
                        @endif
                        @else
                        {{date("j.m.Y", strtotime($tourArray['startTime']));}} - {{date("j.m.Y", strtotime($tourArray['endTime']));}}
                        @endif
                    </li>

                    <li><i class="icon-map-marker color-orange" title="Место проведения тура"></i> {{$tourArray['location']}}</li>
                    @if($tourArray['level_id'] != 0)
                    <li><i class="icon-signal color-orange"  title="Уровень подготовки"></i>
                        {{$tourArray['level']}}</li>
                    @endif
                </ul>

                <div class="accordion acc-home" id="accordion-1">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne">
                                {{trans('futureItem.about')}}
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body in collapse" style="height: auto;">
                            <div class="accordion-inner">
                                {{$tourArray['description']}}
                            </div>
                        </div>
                    </div><!--/accordion-group-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse"  href="#collapseTwo">
                                {{trans('futureItem.residence')}}
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
                            <div class="accordion-inner">
                                {{$tourArray['residence']}}
                            </div>
                        </div>
                    </div><!--/accordion-group-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse"  href="#collapseThree">
                                {{trans('futureItem.feed')}}
                            </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse" style="height: 0px;">
                            <div class="accordion-inner">
                                {{$tourArray['feed']}}
                            </div>
                        </div>
                    </div><!--/accordion-group-->

                </div>

            </div>

        </div><!--/row-fluid-->

        <!-- Recent Works -->
        @if(count($futureArray) > 2)
        <div class="headline"><h3>{{trans('futureItem.past')}}</h3></div>
        <div class="row-fluid margin-bottom-40">

            <ul id="list" class="bxslider recent-work">
                @foreach($futureArray as $future)
                @if($future['tour_id'] == $tourArray['tour_id'])                
                @else
                <li>
                    <a href="{{ URL::to(Config::get('app.locale') . '/futureTours/' . $future['tour_id'])}}">
                        <em class="overflow-hidden"> {{ HTML::image('images/tours/tour_'.$future['tour_id'].'/enduroTour1.jpeg', 'a picture') }}</em>
                        <span>
                            <strong>{{$future['name']}}</strong>
                            <i>  @if($future['nodateactive'] == 1)
                                @if($future['nodate'] == '')
                                -----
                                @else
                                {{$future['nodate']}}
                                @endif
                                @else
                                {{date("j.m.Y", strtotime($future['startTime']));}} - {{date("j.m.Y", strtotime($future['endTime']));}}
                                @endif</i>
                        </span>
                    </a>
                </li>
                @endif
                @endforeach
              



            </ul>        
        </div><!--/row-->
        @endif
        <!-- //End Recent Works -->                
    </div><!--/container-->	 	
    <!--=== End Content Part ===-->
    @stop
    @section('footerscript')
     {{HTML::script('assets/plugins/bxslider/jquery.bxslider.js')}}
    <script type = "text/javascript" >
        jQuery(document).ready(function () {
            App.init();
            App.initBxSlider1();

            App.initSliders();

        });</script>
    @stop
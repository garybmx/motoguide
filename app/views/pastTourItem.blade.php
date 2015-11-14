@extends('layouts.base')
@section('title')
<title>{{trans('pastTourItem.title')}}</title>
<meta name="description" content="{{trans('pastTourItem.description')}}" />
<meta name="keywords" content="{{trans('pastTourItem.keywords')}}">
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
            <a href="{{ URL::to(Config::get('app.locale') . '/pastTours')}}">
                @elseif(HTML::prevPage() == true)
                <a href="{{ URL::to(Config::get('app.locale') . '/pastTours')}}">
                    @else
                    <a href="{{ URL::previous()}}">
                        @endif
                        <i class="icon-angle-left"></i> {{trans('pastTourItem.header')}}</a></h1>
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">{{trans('pastTourItem.menu1')}}</a> <span class="divider">/</span></li>
                        <li><a href="index.html">{{trans('pastTourItem.menu2')}}</a> <span class="divider">/</span></li>
                        <li class="active ">{{trans('pastTourItem.menu3')}}</li>
                    </ul>
                    </div><!--/container-->
                    </div><!--/breadcrumbs-->
                    <!--=== End Breadcrumbs ===-->

                    <!--=== Content Part ===-->

                    <div class="container content-sm">
                        <div class="row">
                            <!-- Blog All Posts -->
                            <div class="col-md-8">
                                <!-- News v3 -->
                                <div class="news-v3 bg-color-white margin-bottom-30">

                                    {{ HTML::image('images/tours/tour_'.$tourArray['tour_id'].'/enduroTour1.jpeg', trans('pastTourItem.mainpic'), array('class' => 'img-responsive full-width')) }}

                                    <div class="news-v3-in">
                                        <h2>"{{$tourArray['name']}}"</h2>
                                        <ul class="list-inline posted-info">
                                            <li><i class="icon-calendar color-orange"  title="{{trans('pastTourItem.time')}}"></i> 
                                                @if($tourArray['nodateactive'] == 0)                            
                                                {{$tourArray['start_month']}} {{(int)$tourArray['start_day']}}, {{$tourArray['start_year']}} - {{$tourArray['end_month']}} {{(int)$tourArray['end_day']}}, {{$tourArray['end_year']}}
                                                @else
                                                {{$tourArray['nodate']}}
                                                @endif
                                            </li>
                                            <li><i class="icon-map-marker color-orange" title="{{trans('pastTourItem.place')}}"></i>{{$tourArray['location']}}</li>                     
                                        </ul>

                                        <p class="description">{{$tourArray['description']}}</p>

                                        <h4>{{trans('pastTourItem.review')}}</h4>
                                        <p>{{$tourArray['review']}}</p>

                                    </div>
                                </div>                        
                                <!-- End News v3 -->

                              

                            </div>
                            <!-- End Blog All Posts -->

                            <!-- Blog Sidebar -->
                            <div class="col-md-4">

                                @if(count($fileArray) > 1)
                                <h2 class="title-v4">{{trans('pastTourItem.photo')}}</h2>
                                <!-- Photostream -->
                                <ul class="list-inline blog-photostream margin-bottom-50">
                                    @for($i = 0; $i<count($fileArray);$i++)
                                        <li>
                                            <a href="{{ URL::to('images/tours/tour_'.$tourArray['tour_id'].'/' . $fileArray[$i] ) }}" rel="gallery" class="fancybox-button img-hover-v2" title="{{trans('pastTourItem.pic') . $tourArray['name']. ' '. ($i+1) }}">
                                                <span>    {{ HTML::image('images/tours/tour_'.$tourArray['tour_id'].'/'.$fileArray[$i],trans('pastTourItem.pic') . $tourArray['name'], array('class' => 'img-responsive', 'title' => trans('pastTourItem.pic') . $tourArray['name'])) }}</span>                             
                                            </a>
                                        </li>
                                        @endfor



                                </ul>

                                @endif
                                <!-- Blog Newsletter -->
                                @if(!empty($clientArray))
                                <!-- End Photostream --><h2 class="title-v4">{{trans('pastTourItem.reviews')}}</h2>
                                @foreach($clientArray as $client)
                                <div class="testimonials-v4 margin-bottom-40">
                                    <div class="testimonials-v4-in testimonials-bg-dark">
                                        <p>{{$client['review']}}</p>
                                    </div>
                                    @if(file_exists(base_path() . '\public\images\clients\client_' . $client['id'] . '.jpeg'))
                                    {{ HTML::image('/images/clients/client_'.$client['id'].'.jpeg', trans('pastTourItem.clientPic'), array('class' => 'rounded-x')) }}
                                    @endif
                                    <span class="testimonials-author">
                                        {{$client['name']}}<br>

                                    </span>
                                </div>
                                <br>
                                @endforeach


                                @endif
                                
                                @if(!empty($futureArray))
                                <h2 class="title-v4">{{trans('pastTourItem.future')}}</h2>
                                @foreach($futureArray as $futureTour)
                                <div class="blog-thumb blog-thumb-circle margin-bottom-15">
                                    <div class="blog-thumb-hover">
                                        {{ HTML::image('images/tours/tour_'.$futureTour['tour_id'].'/enduroTour1.jpeg', trans('pastTourItem.futurePic')  . $futureTour['name'], array('class' => 'rounded-x')) }}

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
                                @endif
                                <br><br>





                                <!-- End Blog Newsletter -->
                            </div>
                            <!-- End Blog Sidebar -->                
                        </div>
                        
                        
                    </div><!--/end container-->
 
                    <!--=== End Content Part ===-->

                    @stop
                    @section('footerscript')

                    {{HTML::script('assets/plugins/backstretch/jquery.backstretch.min.js')}}
                    {{HTML::script('assets/plugins/fancybox/source/jquery.fancybox.pack.js')}}
                    {{HTML::script('assets/plugins/bxslider/jquery.bxslider.js')}}
                    <script type = "text/javascript" >
                        jQuery(document).ready(function () {
                            App.init();
                            App.initBxSlider1();
                            App.initFancybox();

                        });</script>


                    @stop
@extends('layouts.base')

@section('title')
<title>{{trans('index.title')}}</title>
<meta name="description" content="{{trans('index.description')}}" />
<meta name="keywords" content="{{trans('index.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
@stop

@section('headercss')
{{HTML::style('assets/plugins/flexslider/flexslider.css')}}   
{{HTML::style('assets/plugins/parallax-slider/css/parallax-slider.css')}}
{{HTML::style('assets/plugins/bxslider/jquery.bxslider.css')}}
{{HTML::style('assets/plugins/countdown/css/countdown.css')}}
{{HTML::style('assets/plugins/countdown/css/jquery.countdown.css')}}
@stop

@section('body')

<div class="slider-inner">
    <div id="da-slider" class="da-slider">
        <div class="da-slide">
            <h2>{{$information['banner_head_1']}}</h2>
            <p>{{$information['banner_text_1']}}</p>

            <div class="da-img">{{ HTML::image('images/informations/banner_1.png', trans('index.banner1')) }}</div>
        </div>
        <div class="da-slide">
            <h2>{{$information['banner_head_2']}}</h2>
            <p>{{$information['banner_text_2']}}</p>
            <div class="da-img">
                {{ HTML::image('images/informations/banner_2.png', trans('index.banner2')) }}
            </div>
        </div>
        <div class="da-slide">
            <h2>{{$information['banner_head_3']}}</h2>
            <p>{{$information['banner_text_3']}}</p>
            <div class="da-img">
                {{HTML::image('images/informations/banner_3.png', trans('index.banner3')) }}
            </div>
        </div>
        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>        
        </nav>
    </div><!--/da-slider-->
</div><!--/slider-->

<!--=== End Slider ===-->

<!-- Purchase Block -->
@if(!empty($futureTourArray))
<div class="row-fluid margin-top-10 margin-bottom-15">
    <div class="container">
        <div class="headline"><h3 class="color-orange">{{trans('index.nexttour')}}</h3></div>
        <div class="col-md-7 clearfix "><!-- Just delete "bg-light" class to hide background color -->

            <p>{{ HTML::image('images/tours/tour_'.$futureTourArray['tour_id'].'/enduroTour1.jpeg', $futureTourArray['name'], array('class' => 'pull-left lft-img-margin img-width-200')) }}<h3>{{$futureTourArray['name']}}</h3></p>

            <p>{{$futureTourArray['description']}}</p>	
            <a href="{{ URL::to(Config::get('app.locale') . '/futureTours/' . $futureTourArray['tour_id'])}}" class="read-more"><i>Подробнее...</i></a>



        </div>
        <div class="col-md-5"><!-- Just delete "bg-light" class to hide background color -->

            <h2 class="text-center" id='countdown_h2'>
                @if(!empty($timerArray)){{trans('index.timefornext')}}
                @else &nbsp;
                @endif</h2>             
            <p> <div id="defaultCountdown" class=" text-center"></div>

            <p class="text-center"><a href="{{ URL::to(Config::get('app.locale') . '/request?request='.$futureTourArray['tour_id'])}}" class="btn-u btn-u-orange btn-u-large hover-effect">{{trans('index.requestbutton')}}</a></p>   
        </div>


    </div>
</div><!--/row-fluid-->
@endif
<!-- End Purchase Block -->

<!--=== Content Part ===-->
<div class="container">		
    <!-- Service Blocks -->

    <!-- //End Service Blokcs -->

    <div class="row equal-height margin-top-30 margin-bottom-30 ">
        <div class="col-md-4 equal-height-in">
            <div class="service-block-v1 md-margin-bottom-50">
                <i class="rounded-x icon- hover-icon">&#xf080;</i>
                <h3 class="title-v3-bg text-uppercase">{{$information['info_head_1']}}</h3>
                <p>{{$information['info_text_1']}}</p>

            </div>    
        </div>
        <div class="col-md-4 equal-height-in">
            <div class="service-block-v1 md-margin-bottom-50">
                <i class="rounded-x icon- hover-icon">&#xf0fc;</i>
                <h3 class="title-v3-bg text-uppercase">{{$information['info_head_2']}}</h3>
                <p>{{$information['info_text_2']}}</p>

            </div>    
        </div>
        <div class="col-md-4 equal-height-in">
            <div class="service-block-v1 md-margin-bottom-50">
                <i class="rounded-x icon- hover-icon">&#xf0c0;</i>
                <h3 class="title-v3-bg text-uppercase">{{$information['info_head_3']}}</h3>
                <p>{{$information['info_text_3']}} </p>

            </div>    
        </div>
    </div>


    <!-- About Us -->
    <div class="headline"><h3>{{trans('index.about')}}</h3></div>
    <div class="row-fluid margin-bottom-40">
        <div class="span6">
            {{$information['about_1']}}
            <!-- Blockquotes -->
            @if(!empty($clientArray))
            @foreach($clientArray as $client)
            <br>
            <blockquote>                        
                <p>{{$client['review']}}</p>
                <small>{{$client['name']}}</small>
            </blockquote>
            @endforeach
            @endif

        </div>
        <div class="span6">
            <iframe src=" {{$information['video_1']}}" width="100%" height="327" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> 
        </div>
    </div><!--/row-fluid-->	
    <!--//End About Us -->

    <!-- Recent Works -->
    @if(!empty($pastTourArray))
    <div class="headline"><h3>{{trans('index.pastTours')}}</h3></div>
    <div class="row-fluid margin-bottom-50">
        <ul id="list" class="bxslider recent-work">
            @foreach($pastTourArray as $pastTour)
            <li>
                <a href="{{ URL::to(Config::get('app.locale')  . '/pastTours/' . $pastTour['tour_id'])}}">
                    <em class="overflow-hidden">{{ HTML::image('images/tours/tour_'.$pastTour['tour_id'].'/enduroTour1.jpeg', trans('index.altPicPastTour') . $pastTour['name']) }}
                    </em>
                    <span>
                        <strong>{{$pastTour['name']}}</strong>
                        <i class="icon-calendar color-orange"></i>  {{date("d.m.Y", strtotime($pastTour['startTime']))}}
                    </span>
                </a>
            </li>
            @endforeach           

        </ul>        
    </div><!--/row-->
    @endif
    <!-- //End Recent Works -->


    <!-- Our Clients -->
    <div id="clients-flexslider" class="flexslider home clients">

        <ul class="slides">
            <li>
                <a>
                    <img src="assets/img/clients/GoPro_grey.png" alt="" /> 
                    <img src="assets/img/clients/GoPro.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/ktm_grey.png" alt="" /> 
                    <img src="assets/img/clients/ktm.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/shoei_grey.png" alt="" /> 
                    <img src="assets/img/clients/shoei.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/dainese_grey.png" alt="" /> 
                    <img src="assets/img/clients/dainese.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/shell_grey.png" alt="" /> 
                    <img src="assets/img/clients/shell.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/oneal_grey.png" alt="" /> 
                    <img src="assets/img/clients/oneal.png" class="color-img" alt="" />
                </a>

            </li>
            <li>
                <a>
                    <img src="assets/img/clients/fox_grey.png" alt="" /> 
                    <img src="assets/img/clients/fox.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/alpinestars_grey.png" alt="" /> 
                    <img src="assets/img/clients/alpinestars.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/ixs_grey.png" alt="" /> 
                    <img src="assets/img/clients/ixs.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/airoh_grey.png" alt="" /> 
                    <img src="assets/img/clients/airoh.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/maxxis_grey.png" alt="" /> 
                    <img src="assets/img/clients/maxxis.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/thor_grey.png" alt="" /> 
                    <img src="assets/img/clients/thor.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/ktm_grey.png" alt="" /> 
                    <img src="assets/img/clients/ktm.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a>
                    <img src="assets/img/clients/oneal_grey.png" alt="" /> 
                    <img src="assets/img/clients/oneal.png" class="color-img" alt="" />
                </a>
                </
        </ul>
    </div><!--/flexslider-->
    <!-- //End Our Clients -->
</div><!--/container-->	

@stop

@section('footerscript')
{{HTML::script('assets/js/pages/index.js')}}

{{HTML::script('assets/plugins/countdown/jquery.countdown.js')}}
{{HTML::script('assets/plugins/countdown/jquery.countdown-ru.js')}}
{{HTML::script('assets/plugins/backstretch/jquery.backstretch.min.js')}}
{{HTML::script('assets/plugins/flexslider/jquery.flexslider-min.js')}}
{{HTML::script('assets/plugins/parallax-slider/js/modernizr.js')}}
{{HTML::script('assets/plugins/parallax-slider/js/jquery.cslider.js')}}
{{HTML::script('assets/plugins/bxslider/jquery.bxslider.js')}}



<script type = "text/javascript" >
    jQuery(document).ready(function () {
            
    App.init();
            App.initBxSlider1();
            App.initSliders();
            Index.initParallaxSlider();
    });</script>


@if(!empty($timerArray))
<script type="text/javascript">
            $(document).ready(function () {
    var austDay = new Date();
            austDay = new Date({{$timerArray['countdown'][0]}}, {{$timerArray['countdown'][1] - 1}}, {{$timerArray['countdown'][2]}}, {{$timerArray['countdown'][3]}}, {{$timerArray['countdown'][4]}}, {{$timerArray['countdown'][5]}});
            $('#defaultCountdown').countdown({until: austDay});
            $('#year').text(austDay.getFullYear());
    });

</script>
@endif
@stop
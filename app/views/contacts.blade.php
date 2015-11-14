@extends('layouts.base')

@section('title')
<title>{{trans('contact.title')}}</title>
<meta name="description" content="{{trans('contact.description')}}" />
<meta name="keywords" content="{{trans('contact.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop


@section('body')
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('contact.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('contact.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('contact.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div>

<div class="container content">		
    <div class="row margin-bottom-60">
        <div class="col-md-6">
            <!-- Google Map -->
            <div id="map" class="height-450">
            </div>
            <!-- End Google Map -->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- Get in Touch -->


            <!-- Contacts -->
            <div class="headline"><h3>{{trans('contact.contact')}}</h3></div>
            <ul class="unstyled who margin-bottom-10">
                <li><i class="icon-home"></i>{{$contactArray['address']}}</li>
                <li><i class="icon-envelope-alt"></i>{{$contactArray['mail']}}</li>
                <li><i class="icon-phone-sign"></i>{{$contactArray['phone']}}</li>
               
            </ul>

            <hr>

            <div class="headline"><h3>{{trans('contact.about')}}</h3></div>
           {{$infoArray['about_1']}}

        </div>
    </div>

    <!-- Owl Clients v1 -->

</div><!--/container-->		
<!--=== End Content Part ===-->

@stop

@section('footerscript')
{{HTML::script('http://maps.google.com/maps/api/js?sensor=true')}}
{{HTML::script('assets/plugins/gmap/gmap.js')}}
{{HTML::script('assets/js/pages/contact.js')}}
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.init();
        Contact.initMap();

      

    });
</script>
@stop

@extends('layouts.base')
@section('title')
<title>{{trans('motorcycles.title')}}</title>
<meta name="description" content="{{trans('motorcycles.description')}}" />
<meta name="keywords" content="{{trans('motorcycles.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop


@section('body')
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('motorcycles.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('motorcycles.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('motorcycles.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div>



<!-- Grid Options -->
<div class="container">
    <div class="row-fluid margin-bottom-20">
        @if(!empty($motorcyclesArray))
        @foreach($motorcyclesArray as $motorcycle)
        <div class="row team-v7 no-gutter equal-height-columns margin-bottom-40">
            <div class="col-md-6 team-arrow-right">
                <div class="dp-table">
                    <div class="equal-height-column dp-table-cell team-v7-in" style="height: 555px;">
                        <span class="team-v7-name">{{$motorcycle['model']}}</span>
                        <ul class="unstyled">
                            <li class="color-grey">{{trans('motorcycles.power')}}: {{$motorcycle['power']}}</li>
                            <li class="color-grey">{{trans('motorcycles.weight')}}: {{$motorcycle['weight']}} {{trans('motorcycles.kilo')}}.</li>
                        </ul>

                        <p>{{$motorcycle['description']}}</p>

                    </div>
                </div>
            </div>
            <div class="col-md-6 team-v7-img">
                {{ HTML::image('/images/motorcycles/motorcycle_'.$motorcycle['id'].'.jpeg', trans('motorcycles.picture') . $motorcycle['model'], array('class' => 'full-width equal-height-column', 'style'=>'height: 555px;')) }}
                

            </div>
        </div>
        @endforeach
        @else
        <h2 class="margin-bottom-100">{{trans('motorcycles.notFoundMotorcycles')}}</h2>
        @endif
        
    </div><!--/row-fluid-->


</div>	
@stop

@extends('layouts.base')

@section('title')
<title>{{trans('request.title')}}</title>
<meta name="description" content="{{trans('request.description')}}" />
<meta name="keywords" content="{{trans('request.keywords')}}">
<meta http-equiv="content-language" content="{{Config::get('app.locale')}}">
<meta name="author" content="Igor Ukolov" />
@stop

@section('body')


<div class="breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="color-green pull-left">{{trans('request.header')}}</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{trans('request.menu1')}}</a> <span class="divider">/</span></li>
            <li class="active">{{trans('request.menu2')}}</li>
        </ul>
    </div><!--/container-->
</div>
<!--=== Content Part ===-->
<div class="container">		
    @if($errors->has('notdone'))

    <div class="alert alert-danger" id="messageBox">
        {{$errors->first('notdone')}}
    </div>
    @endif
    @if($errors->has('done'))
    <div class="alert alert-success" id="messageBox">
        {{$errors->first('done')}}
       
    </div>
    @endif
    <div class="row-fluid">
        <div class="span9">


            {{Form::open(array('action' => array('RequestController@update'), 'method'=>'post'))}}
            {{ Form::hidden('lang', Config::get('app.locale')) }}
            <label>{{trans('request.name')}}</label>
            {{ Form::text('name', null, array('class' => 'span7 border-radius-none')) }}
            {{ $errors->first('name', '<div class="alert alert-danger">:message</div>') }}

            <label>{{trans('request.email')}} <span class="color-red">*</span></label>
            {{ Form::text('email', null, array('class' => 'span7 border-radius-none')) }}
            {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}

            <label>{{trans('request.phone')}}</label>
            {{ Form::text('phone', null, array('class' => 'span7 border-radius-none')) }}
            {{ $errors->first('phone', '<div class="alert alert-danger">:message</div>') }}


            <label>{{trans('request.tour')}}</label>
            {{Form::select('tour', $tourArray, $selected, array('class' => 'span7'));}}
            
            <label>{{trans('request.message')}}</label>
            {{ Form::textarea('comment', null, array('class' => 'span10')) }}
            {{ $errors->first('comment', '<div class="alert alert-danger">:message</div>') }} 
            <p>
                {{Form::submit(trans('request.button'), array( 'class'=>'btn-u'))}}
            </p>
            {{Form::close()}}
            </form>
        </div><!--/span9-->

        <div class="span3">


            {{trans('request.info')}}                    
            <!-- Contacts -->
            <div class="headline"><h3>{{trans('request.contact')}}</h3></div>
            <ul class="unstyled who margin-bottom-20">
                <li><i class="icon-home"></i>{{$contactArray['address']}}</li>
                <li><i class="icon-envelope-alt"></i>{{$contactArray['mail']}}</li>
                <li><i class="icon-phone-sign"></i>{{$contactArray['phone']}}</li>
            </ul>



            <!-- Why we are? -->

        </div><!--/span3-->
    </div><!--/row-fluid-->        


    <!-- //End Our Clients -->
</div><!--/container-->		
<!--=== End Content Part ===-->


@stop

@section('footerscript')
  
<script type="text/javascript">
    $(document).ready(function () {
        if ($("div").is("#messageBox")) {
           @if($errors->has('done'))
            swal({  
              title: "{{trans('request.thanx')}}", 
              text: "{{trans('request.thanx2')}}",
              type: "success",
              confirmButtonColor: "#FB7115", });
            @endif
            
             @if($errors->has('notdone'))
                 swal({  
              title: "{{trans('request.error')}}", 
              text: "{{trans('request.error2')}}",
              type: "warning",
              confirmButtonColor: "#FB7115", });
            @endif
            
                    setTimeout(function () {
                        $('#messageBox').fadeOut('slow').remove();

                    }, 15000);
        }



    });</script>

@stop


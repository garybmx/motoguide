<!DOCTYPE html>
<!--[if IE 7]> <html lang="{{Config::get('app.locale')}}" class="ie7"> <![endif]-->  
<!--[if IE 8]> <html lang="{{Config::get('app.locale')}}" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="{{Config::get('app.locale')}}" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="{{Config::get('app.locale')}}"> <!--<![endif]-->  
    @include('layouts.head')

    <body>

        <noscript>
        <div class="alert alert-block col-md-12">
            <h4 class="alert-heading">Warning!</h4>

            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                enabled to use this site.</p>
        </div>
        </noscript>
        <!--=== Top ===-->    
        <div class="top">
            <div class="container">         
                <ul class="loginbar pull-right">
                    <li><i class="icon-">&#xf0ac;</i><a>Languages <i class="icon-sort-up"></i></a>
                        <ul class="nav-list">

                            @if(Request::segment(1) == 'en' || Config::get('app.locale') == 'en')
                            <li class="active">
                                @else <li>    
                                @endif
                                <a href="{{ URL::to('en/' . Request::segment(2).'/'. Request::segment(3). '/'. Request::segment(4)) }}">English</a> @if(Request::segment(1) == 'en' || Config::get('app.locale') == 'en')<i class="icon-ok"></i>@endif</li>
                            @if(Request::segment(1) == 'ru' || Config::get('app.locale') == 'ru')
                            <li class="active">
                                @else <li>    
                                @endif
                                <a href="{{ URL::to('ru/' . Request::segment(2).'/'. Request::segment(3). '/'. Request::segment(4)) }}">Russian</a> @if(Request::segment(1) == 'ru' || Config::get('app.locale') == 'ru')<i class="icon-ok"></i>@endif</li>

                        </ul>
                    </li>   
                    <li><a href="mailto:{{$contactArray['mail']}}"><i class="icon-">&#xf0e0;</i> {{$contactArray['mail']}}</a></li> 
                    <li><a href="#"><i class="icon-">&#xf095;</i>{{$contactArray['phone']}}</a></li>   


                </ul>
            </div>      
        </div><!--/top-->
        <!--=== End Top ===-->    

        <!--=== Header ===-->
        <div class="header">               
            <div class="container"> 
                <!-- Logo -->       
                <div class="logo">                                             
                    <a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">
                        {{ HTML::image('assets/img/logo2-default.png', 'Enduro Tours logo', array('id' => 'logo-header')) }}                        
                </div><!-- /logo -->        

                <!-- Menu -->       
                @include('layouts.menu')                      
            </div><!-- /container -->               
        </div><!--/header -->      
        <!--=== End Header ===-->

        <!--=== Slider ===-->
        @yield('body') 	
        <!-- End Content Part -->

        <!--=== Footer ===-->
        @include('layouts.footer')
        <!--=== End Footer ===-->


        <!-- JS Global Compulsory -->           
        {{HTML::script('assets/js/jquery-1.8.2.min.js')}}
        {{HTML::script('assets/js/modernizr.custom.js')}}    
        {{HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js')}}
        {{HTML::script('assets/plugins/back-to-top.js')}}
        {{HTML::script('assets/js/app.js')}}
        {{HTML::script('js/done.js')}}    
        <!-- JS Page Level -->           
      

        @if($errors->has('letterdone'))
        <!--[if IE]>
         {{HTML::script('js/doneie.js')}}
          <script type = "text/javascript" >
            jQuery(document).ready(function () {                
               done_alert("{{trans('request.letterMes')}}");
            });</script>
       <![endif]-->
        <![if !IE]>
        {{HTML::script('js/done.js')}}    
         <script type = "text/javascript" >
            jQuery(document).ready(function () {                
               done_alert("{{trans('request.letterMes')}}");
            });</script>
        <![endif]>
        @endif

        @if($errors->has('letternotdone'))
        <!--[if IE]>
         {{HTML::script('js/doneie.js')}}
          <script type = "text/javascript" >
            jQuery(document).ready(function () {                
               not_alert("{{trans('request.letterError')}}");
            });</script>
       <![endif]-->
        <![if !IE]>
        {{HTML::script('js/done.js')}}    
         <script type = "text/javascript" >
            jQuery(document).ready(function () {                
               not_alert("{{trans('request.letterError')}}");
            });</script>
        <![endif]>
        @endif


        <!--[if lt IE 9]>
           {{HTML::script('assets/js/respond.js')}}
           {{HTML::script('js/ie8.js')}}          
       <![endif]-->
        <![if !IE]>
        {{HTML::script('js/sweetalert.min.js')}}    
        <![endif]>
        @yield('footerscript')







        <!--
       <script type="text/javascript">
           var _gaq = _gaq || [];
           _gaq.push(['_setAccount', 'UA-29166220-1']);
           _gaq.push(['_setDomainName', 'htmlstream.com']);
           _gaq.push(['_trackPageview']);

           (function () {
               var ga = document.createElement('script');
               ga.type = 'text/javascript';
               ga.async = true;
               ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
               var s = document.getElementsByTagName('script')[0];
               s.parentNode.insertBefore(ga, s);
           })();
       </script>
        -->

    </body>
</html> 
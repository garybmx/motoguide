<!DOCTYPE html>
<!--[if IE 7]> <html lang="en" class="ie7"> <![endif]-->  
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
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
                    <li><i class="icon-globe"></i><a>Languages <i class="icon-sort-up"></i></a>
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
                    <li><a href="mailto:info@anybiz.com"><i class="icon-envelope-alt"></i> info@anybiz.com</a></li> 
                    <li><a href="#"><i class="icon-phone-sign"></i> 010 4202 2656</a></li>   


                </ul>
            </div>      
        </div><!--/top-->
        <!--=== End Top ===-->    

        <!--=== Header ===-->
        <div class="header">               
            <div class="container"> 
                <!-- Logo -->       
                <div class="logo">                                             
                    <a href="index.html"><img id="logo-header" src="assets/img/logo2-default.png" alt="Logo" /></a>
                </div><!-- /logo -->        

                <!-- Menu -->       
                @include('layouts.menu')                      
            </div><!-- /container -->               
        </div><!--/header -->      
        <!--=== End Header ===-->

        <!--=== Slider ===-->
        @yield('admin.body') 	
        <!-- End Content Part -->

        <!--=== Footer ===-->
        @include('layouts.footer')
        <!--=== End Footer ===-->

        <!-- JS Global Compulsory -->           
        {{HTML::script('assets/js/jquery-1.8.2.min.js')}}
        {{HTML::script('assets/js/modernizr.custom.js')}}     
        {{HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js')}}
        <!-- JS Implementing Plugins -->           
        {{HTML::script('assets/plugins/flexslider/jquery.flexslider-min.js')}}
        {{HTML::script('assets/plugins/parallax-slider/js/modernizr.js')}}
        {{HTML::script('assets/plugins/parallax-slider/js/jquery.cslider.js')}}
        {{HTML::script('assets/plugins/bxslider/jquery.bxslider.js')}}
        {{HTML::script('assets/plugins/back-to-top.js')}}
        <!-- JS Page Level -->           
        {{HTML::script('assets/js/app.js')}}
        {{HTML::script('assets/js/pages/index.js')}}
        <script type="text/javascript">
            jQuery(document).ready(function () {
                App.init();
                App.initSliders();
                App.initBxSlider1();
                Index.initParallaxSlider();
            });
        </script>
        <!--[if lt IE 9]>
            {{HTML::script('assets/js/respond.js')}}
        <![endif]-->
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
    </body>
</html> 
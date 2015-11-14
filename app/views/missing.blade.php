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

        <!--=== End Top ===-->    

        <!--=== Header ===-->
        <div class="header margin-bottom-50">               
            <div class="container"> 
                <!-- Logo -->       
                <div class="logo">                                             
                    <a href="{{URL::to(Config::get('app.locale')  . '/' ) }}">
                        {{ HTML::image('assets/img/logo2-default.png', 'Enduro Tours logo', array('id' => 'logo-header')) }}    </a>                    
                </div><!-- /logo -->        



            </div><!-- /container -->               
        </div><!--/header -->      
        <!--=== End Header ===-->


        <!--=== Content Part ===-->
        <div class="container">		
            <div class="row-fluid page-404">
                <p><i>404</i> <span>The Page cannot be found</span></p>
            </div><!--/row-fluid-->        
        </div><!--/container-->		
        <!--=== End Content Part ===-->



        <!--[if lt IE 9]>
            {{HTML::script('assets/js/respond.js')}}
        <![endif]-->
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
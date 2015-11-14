

<head>

    @yield('title') 
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.ico" /> 
    <link rel="icon" type="image/icon" href="favicon.ico">

    <!-- CSS Global Compulsory-->
    {{HTML::style('assets/plugins/bootstrap/css/bootstrap.min.css')}}
    {{HTML::style('assets/css/style.css')}}
   
    {{HTML::style('assets/css/headers/header1.css')}}
    {{HTML::style('assets/plugins/bootstrap/css/bootstrap-responsive.min.css')}}
    {{HTML::style('assets/css/style_responsive.css')}}
    {{HTML::style('assets/css/img-hover-effect.css')}}
    {{HTML::style('assets/css/instructors.min.css')}}
    {{HTML::style('assets/css/blocks.css')}}
 {{HTML::style('css/sweetalert.css')}} 
    {{HTML::style('css/myCustom.css')}}
    <![if !IE]>{{HTML::style('css/myCustom2.css')}}
    {{HTML::style('css/col.css')}}
    <![endif]>
   
    
    <!--[if IE]>
     {{HTML::style('assets/css/styleie.css')}}
     {{HTML::style('css/ie.css')}}
    <![endif]-->
    <!-- CSS Implementing Plugins -->    
   
    {{HTML::style('assets/plugins/font-awesome/css/font-awesome.css')}}
    {{HTML::style('assets/plugins/fancybox/source/jquery.fancybox.css')}}
    <link rel="shortcut icon" href="{{URL::to('img/favicon.ico')}}">
    @yield('headercss') 
    <!-- CSS Theme -->    

</head> 
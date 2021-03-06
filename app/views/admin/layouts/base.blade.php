<!DOCTYPE html>
<html lang="ru">
    @include('admin.layouts.head')


    <body>
        @include('admin.layouts.topmenu')

        <div class="ch-container">
            <div class="row">

                @include('admin.layouts.leftmenu')


                <noscript>
                <div class="alert alert-block col-md-12">
                    <h4 class="alert-heading">Warning!</h4>

                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                        enabled to use this site.</p>
                </div>
                </noscript>

                <div id="content" class="col-lg-10 col-sm-10">
                    @yield('admin.body') 

                </div><!--/#content.col-md-0-->
            </div><!--/fluid-row-->



            <hr>


            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; Gary</p>
                <p> ver. 1.0 (beta)</p>


            </footer>

        </div><!--/.fluid-container-->

        <!-- external javascript -->

        {{HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js')}}

        <!-- library for cookie management -->
        {{HTML::script('js/jquery.cookie.js')}}
    
        <!-- calender plugin -->
        {{HTML::script('bower_components/moment/min/moment.min.js')}}
        {{HTML::script('bower_components/fullcalendar/dist/fullcalendar.min.js')}}
        <!-- data table plugin -->
        {{HTML::script('js/jquery.dataTables.min.js')}}

        <!-- select or dropdown enhancer -->
        {{HTML::script('bower_components/chosen/chosen.jquery.min.js')}}
        <!-- plugin for gallery image view -->
        {{HTML::script('bower_components/colorbox/jquery.colorbox-min.js')}}
        <!-- notification plugin -->
        {{HTML::script('js/jquery.noty.js')}}
        <!-- library for making tables responsive -->
        {{HTML::script('bower_components/responsive-tables/responsive-tables.js')}}
        <!-- tour plugin -->
        {{HTML::script('bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js')}}
        <!-- star rating plugin -->
        {{HTML::script('js/jquery.raty.min.js')}}
        <!-- for iOS style toggle switch -->
        {{HTML::script('js/jquery.iphone.toggle.js')}}
        <!-- autogrowing textarea plugin -->
        {{HTML::script('js/jquery.autogrow-textarea.js')}}
        <!-- multiple file upload plugin -->
        {{HTML::script('js/jquery.uploadify-3.1.min.js')}}
        <!-- history.js for cross-browser state change on ajax -->
        {{HTML::script('js/jquery.history.js')}}
        <!-- application script for Charisma demo -->
        {{HTML::script('js/charisma.js')}}
        {{HTML::script('js/jquery.minical.plain.js')}}
        {{HTML::script('markitup/jquery.markitup.js')}}
        {{HTML::script('markitup/sets/default/set.js')}}
    </body>
</html>


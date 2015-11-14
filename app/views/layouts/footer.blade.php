<div class="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span4">

            </div><!--/span4-->	

            <div class="span4">
                <!-- About -->
                <div class="headline"><h3>{{ trans('footer.about') }}</h3></div>	
                <p class="margin-bottom-25">{{ trans('footer.aboutText') }}</p>	

                <!-- Monthly Newsletter -->
                <div class="headline"><h3>{{ trans('footer.newsletter') }}</h3></div>	
                <p>{{ trans('footer.newsletterText') }}</p>
               
                  {{Form::open(array('action' => array('MailinglistController@update'), 'method'=>'post', 'class'=> 'form-inline'))}}
                <div class="input-append">
                  
                    {{ Form::hidden('newslang', Config::get('app.locale')) }}
                    {{ Form::text('mailinglist', null, array('class' => 'input-medium', 'placeholder'=>'Email Address')) }}
                   
                    {{Form::submit(trans('footer.newsletterButton'), array( 'class'=>'btn-u'))}}

                    {{Form::close()}}
                </div>
 {{ $errors->first('mailinglist', '<div class="alert alert-danger">:message</div>') }}
            </div><!--/span4-->

            <div class="span4">
                <!-- Monthly Newsletter -->
                <div class="headline"><h3>{{ trans('footer.contacts') }}</h3></div>	
                <address>
                    {{$contactArray['address']}}<br />
                    {{ trans('footer.phone') }}: {{$contactArray['phone']}} <br />
                    Email: <a href="mailto:{{$contactArray['mail']}}" class="">{{$contactArray['mail']}}</a>
                </address>

                <!-- Stay Connected -->
                <div class="headline"><h3>{{ trans('footer.stayConnected') }}</h3></div>	
                <ul class="social-icons">

                    <li><a href="#" data-original-title="Facebook" class="social_facebook"></a></li>
                    <li><a href="#" data-original-title="vKontakte" class="social_vk"></a></li>
                    <li><a href="#" data-original-title="Instagram" class="social_instagram"></a></li>
                    <li><a href="#" data-original-title="Vimeo" class="social_vimeo"></a></li>

                </ul>
            </div><!--/span4-->
        </div><!--/row-fluid-->	
    </div><!--/container-->	
</div><!--/footer-->	
<!--=== End Footer ===-->

<!--=== Copyright ===-->
<div class="copyright">
    <div class="container">
        <div class="row-fluid">
            <div class="span8">						
                <p>{{trans('footer.copy')}}</p>
            </div>
            <div class="span4">	

                <a href="{{ URL::to(Config::get('app.locale')  . '/' ) }}">{{ HTML::image('assets/img/logo2-default.png', 'Enduro Tours logo', array('class' => 'pull-right')) }}</a>
            </div>
        </div><!--/row-fluid-->
    </div><!--/container-->	
</div><!--/copyright-->	
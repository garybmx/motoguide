@extends('admin.layouts.base')

@section('admin.body')
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Главная</a>
        </li>

    </ul>
</div>
<div class=" row">

  <script type="text/javascript">
                $(document).ready(function () {
                    if ($("div").is("#messageBox")) {
                        setTimeout(function () {
                            $('#messageBox').fadeOut('slow').remove();
                             
                        }, 5000);
                    }
                    
                    $('#settings_link').parent().addClass('active');
                });</script>


    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" class="well top-block">
            <i class="glyphicon glyphicon-envelope yellow"></i>

            <div>Подписки</div>
            <div>{{$mailinglist}}</div>
           
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="Новые&nbsp;Заявки: {{$requestNew}}" class="well top-block" href="{{URL::to('admin/request')}}">
            <i class="glyphicon glyphicon-user green"></i>

            <div>Заявки</div>
            <div>{{$request}}</div>
            <span class="notification red">{{$requestNew}}</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;Добро пожаловать!</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    @if($errors->has('notdone') || $errors->has('model'))

                    <div class="alert alert-danger" id="messageBox">
                        {{$errors->first('notdone')}}
                    </div>
                    @endif
                    @if($errors->has('done'))
                    <div class="alert alert-success" id="messageBox">
                        {{$errors->first('done')}}
                    </div>
                    @endif
                    
                    <h1>Панель администратора Enduro Tour  <br>

                    </h1>
                    <p>Cтраницы сайта кэшируются. Поэтому, после любых изменений в панели администратора,<br>
                        необходимо обязательно нажать кнопку <b>"обновить кэш"</b>. <br>
                        В противном случае кэш обновится автоматически спустя сутки.
                    </p><br>


                    <p class="center-block download-buttons">
                        {{Form::open(array('action' => array('AdminSettingsController@update'), 'method' => 'put' ))}}
                        <a href="{{URL::to('/')}}" class="btn btn-primary btn-lg"><i
                                class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Вернуться на сайт</a>                        
                        <button type="submit" class="btn btn-default btn-lg"> 
                            <i class="glyphicon glyphicon-repeat icon-white"></i>
                            Обновить кэш
                        </button>    
                        {{Form::close()}}      
                    </p>
                </div>


            </div>
        </div>
    </div>
</div>


<!-- content ends -->

@stop
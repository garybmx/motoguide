@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/contacts', 'Контакты')}}
        </li>

    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        if ($("div").is("#messageBox")) {
            setTimeout(function () {
                $('#messageBox').fadeOut('slow').remove();

            }, 5000);
        }

        $('#contacts_link').parent().addClass('active');
    });</script>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Редактировать контакты:</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>

            </div>


            @if($errors->has('image'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('image')}}
            </div>
            @endif



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

            <div class="box-content">
                <div class="box-content">
                    @if($errors->has('active'))
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#myTab #{{$errors->first('active')}}').addClass("active");
                        });</script>
                    @else
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#myTab a:first').addClass("active");
                        });
                    </script>
                    @endif

                    <ul class="nav nav-tabs" id="myTab"><li>
                            <a href="#rus" id='ru'>Rus</a>
                        </li><li>
                            <a href="#eng" id='en'>Eng</a>    

                        </li>

                    </ul>

                    <div id="myTabContent" class="tab-content">


                        <div class="tab-pane active" id="rus">



                            <p>{{Form::open(array('action' => array('AdminContactsController@update'), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'ru') }}
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td>
                                            {{ Form::label('ru_address', 'Адрес:') }}
                                        </td><td>
                                            {{ Form::text('ru_address', $contactArray['address'], array('class' => 'form-custom', 'size' => '90%')) }}

                                            {{ $errors->first('ru_address', '<div class="alert alert-danger">:message</div>') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('ru_phone', 'Телефон:') }}</td><td>
                                            {{ Form::text('ru_phone', $contactArray['phone'], array('class' => 'form-custom', 'size' => '90%')) }}

                                            {{ $errors->first('ru_phone', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                    <tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('ru_mail', 'Электронная почта:') }}</td><td>
                                            {{ Form::text('ru_mail', $contactArray['mail'], array('class' => 'form-custom', 'size' => '60%')) }}

                                            {{ $errors->first('ru_mail', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                </tbody>
                            </table><p><br>
                                {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                            {{Form::close()}}
                        </div>
                        <div class="tab-pane" id="eng">
                            <p>{{Form::open(array('action' => array('AdminContactsController@update'), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'en') }}
                            <table class="mytable "><tbody>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_address', 'Адрес (ENG):') }}
                                        </td><td>
                                            {{ Form::text('en_address', $contactArrayEng['address'], array('class' => 'form-custom', 'size' => '90%')) }}

                                            {{ $errors->first('en_address', '<div class="alert alert-danger">:message</div>') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_phone', 'Телефон (ENG):') }}</td><td>
                                            {{ Form::text('en_phone', $contactArrayEng['phone'], array('class' => 'form-custom', 'size' => '90%')) }}

                                            {{ $errors->first('en_phone', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_mail', 'Электронная почта (ENG):') }}</td><td>
                                            {{ Form::text('en_mail', $contactArrayEng['mail'], array('class' => 'form-custom', 'size' => '60%')) }}

                                            {{ $errors->first('en_mail', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                </tbody>
                            </table><p><br>
                                {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                            {{Form::close()}}
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-picture"></i> Добавить карту</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <br>

                @if(file_exists(base_path() . '\public\images\contacts\map.jpeg'))
                <p><img src="{{'/images/contacts/map.jpeg?img='. time()}}" class="animated zoomIn"></p>
                {{Form::open(array('action' => array('AdminContactsController@update'), 'method'=>'put', 'id' => 'deleteImage'))}}
                <a class="btn btn-setting btn-success" href="#">
                    <i class="glyphicon glyphicon-share icon-white"></i>
                    Изменить
                </a>
                 {{ Form::hidden('deleteImage', 1) }}
              
                <a class="btn btn-danger" href="#" onclick="document.getElementById('deleteImage').submit();
                        return false;">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Удалить
                </a>
                {{Form::close()}}
                @else
                <p>
                    Изображение не загружено</p>
                <a class="btn btn-setting btn-success" href="#">
                    <i class="glyphicon glyphicon-share icon-white"></i>
                    Добавить
                </a>

                @endif


                <div class="helpbox"><ul>
                        <li>
                            Только файлы формата .jpeg или .jpeg
                        </li>
                        <li>
                            Размер изображения должен быть 640x480 пикселей, в противном случае файл будет уменьшен автоматически
                        </li>
                        <li>
                            Если изображение уже существует, то новое изображение заменит старое
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!--/span-->

</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Добавить фотографию</h3>
            </div>
            <div class="modal-body">
                {{Form::open(array('action' => array('AdminContactsController@update'), 'method'=>'put', 'files'=>true))}}
                {{Form::file('motoPhoto', $attributes = array())}}</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Отмена</a>
                {{Form::submit('Загрузить', array('name'=> 'photo', 'class'=>'btn btn-primary'))}}

            </div>

            {{Form::close()}}
        </div>
    </div>
</div>




<!-- content ends -->

@stop
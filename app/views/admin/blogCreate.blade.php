@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#blogs_link').parent().addClass('active');
         $('input[name="ru_date"]').minical();
           $("#markItUp").markItUp(mySettings);
    });
   
</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/blog', 'Блог')}}
        </li>
        <li>
            {{HTML::link('admin/blog/create', 'Добавить запись')}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Добавить запись </h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">



                <div id="myTabContent" class="tab-content">


                    <p>{{Form::open(array('action' => array('AdminBlogController@store'), 'method'=>'post'))}}</p>
                    {{ Form::hidden('lang', 'ru') }}

                    <table class="mytable  "><tbody>
                            <tr>

                                <td>
                                    {{ Form::label('ru_header', 'Заголовок:') }}
                                </td><td>
                                    {{ Form::text('ru_header', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_header', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_text', 'Текст:') }}</td><td>
                                     {{ Form::textarea('ru_text', null, array('class' => 'form-custom', 'cols'=>'150', 'id'=> 'markItUp')) }}

                                    {{ $errors->first('ru_text', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                           <tr>

                                <td>
                                    {{ Form::label('ru_tags', 'Тэги(через запятую):') }}
                                </td><td>
                                    {{ Form::text('ru_tags', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_tags', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    {{ Form::label('ru_date', 'Дата начала:') }} 
                                </td><td><img src="{{'/images/icon_calendar.png'}}">
                                    {{ Form::text('ru_date', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_date', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_active', 'Статус:') }}</td><td>

                                    {{ Form::checkbox('ru_active','1')}}
                                    Отображать на сайте


                                </td>
                            </tr>
                        </tbody>
                    </table><p><br>
                        {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                    {{Form::close()}}



                </div>

            </div>

        </div>
    </div>
</div>
<!--/span-->







<!-- content ends -->

@stop
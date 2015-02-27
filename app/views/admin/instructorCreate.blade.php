@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#instructors_link').parent().addClass('active');
    });
   
</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/instructors', 'Инструктора')}}
        </li>
        <li>
            {{HTML::link('admin/instructors/create', 'Добавить инструктора')}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Добавить инструктора </h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">



                <div id="myTabContent" class="tab-content">


                    <p>{{Form::open(array('action' => array('AdminInstructorsController@store'), 'method'=>'post'))}}</p>
                    {{ Form::hidden('lang', 'ru') }}

                    <table class="mytable  "><tbody>
                            <tr>

                                <td>
                                    {{ Form::label('ru_name', 'Имя инструктора:') }}
                                </td><td>
                                    {{ Form::text('ru_name', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_name', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_lastname', 'Фамилия инструктора:') }}</td><td>
                                    {{ Form::text('ru_lastname', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_lastname', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_age', 'Возраст:') }}</td><td>
                                    {{ Form::text('ru_age', null, array('class' => 'form-custom', 'size' => '10%'))}}&nbsp;лет.

                                    {{ $errors->first('ru_age', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_expirience', 'Опыт:') }}</td><td>
                                    {{ Form::textarea('ru_expirience', null, array('class' => 'form-custom'))}}

                                    {{ $errors->first('ru_expirience', '<div class="alert alert-danger">:message</div>') }}
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
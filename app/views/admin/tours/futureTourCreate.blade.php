@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#futureTour_link').parent().addClass('active');
        $('input[name="ru_startTime"]').minical();
        $('input[name="ru_endTime"]').minical();
        $("#markItUp").markItUp(mySettings);
        $("#markItUp2").markItUp(mySettings);
        $("#markItUp3").markItUp(mySettings);


    });

</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/FutureTour', 'Предстоящие туры')}}
        </li>
        <li>
            {{HTML::link('admin/FutureTour/create', 'Добавить тур')}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">

            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Добавить тур </h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">



                <div id="myTabContent" class="tab-content">


                    <p>{{Form::open(array('url' => 'admin/FutureTour', 'method' => 'post'))}}</p>
                    {{ Form::hidden('lang', 'ru') }}
                    {{ Form::hidden('tourType_id', '1') }}
                    <table class="mytable  "><tbody>
                            <tr>

                                <td>
                                    {{ Form::label('ru_name', 'Название тура:') }}
                                </td><td>
                                    {{ Form::text('ru_name', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_name', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_startTime', 'Дата начала:') }} 
                                </td><td><img src="{{'/images/icon_calendar.png'}}">
                                    {{ Form::text('ru_startTime', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_startTime', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_endTime', 'Дата окончания:') }}</td><td>
                                    <img src="{{'/images/icon_calendar.png'}}">
                                    {{ Form::text('ru_endTime', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_endTime', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_nodateactive', 'Дата не определена:') }}</td><td>

                                    {{ Form::checkbox('ru_nodateactive','1')}}
                                    Дата не определена


                                </td>
                            </tr>

                            <tr>
                                <td>
                                    {{ Form::label('ru_nodate', 'Примерная дата:') }}</td><td>
                                    {{ Form::text('ru_nodate', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_nodate', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            
                            <tr>
                                <td>
                                    {{ Form::label('ru_duration', 'Продолжительность тура:') }}</td><td>
                                    {{ Form::text('ru_duration', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_duration', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>


                            <tr>
                                <td>
                                    {{ Form::label('ru_description', 'Описание:') }}</td><td>
                                    {{ Form::textarea('ru_description', null, array('class' => 'form-custom', 'id'=> 'markItUp')) }}

                                    {{ $errors->first('ru_description', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>

                            <tr>
                                <td>
                                    {{ Form::label('ru_level_id', 'Уровень:') }}</td><td>

                                    {{ Form::select('ru_level_id', $allLevels, null, array('class' => 'mydrop')) }}

                                    {{ $errors->first('ru_level_id', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>


                            <tr>
                                <td>
                                    {{ Form::label('ru_location', 'Место проведения:') }}</td><td>
                                    {{ Form::text('ru_location', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_location', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_residence', 'Проживание:') }}</td><td>
                                    {{ Form::textarea('ru_residence', null, array('class' => 'form-custom', 'id'=> 'markItUp2')) }}

                                    {{ $errors->first('ru_residence', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>

                            <tr>
                                <td>
                                    {{ Form::label('ru_feed', 'Питание:') }}</td><td>
                                    {{ Form::textarea('ru_feed', null, array('class' => 'form-custom', 'id'=> 'markItUp3')) }}

                                    {{ $errors->first('ru_feed', '<div class="alert alert-danger">:message</div>') }}
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
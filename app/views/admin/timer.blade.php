@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/timer', 'Таймер')}}
        </li>

    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('input[name="ru_date"]').val("{{$timerArray['date']}}").minical({
            date_format: function (date) {
                return [date.getFullYear(), date.getMonth() + 1, date.getDate()].join("-");
            }
        });



    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        if ($("div").is("#messageBox")) {
            setTimeout(function () {
                $('#messageBox').fadeOut('slow').remove();

            }, 5000);
        }


    });</script>

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
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-time"></i> Установить таймер</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <p>{{Form::open(array('action' => array('AdminTimerController@update'), 'method'=>'put'))}}</p>
                {{ Form::hidden('lang', 'ru') }}
                <table class="mytable  "><tbody>
                        <tr>

                            <td>
                                {{ Form::label('ru_date', 'Дата:') }}
                            </td><td>
                                {{ Form::text('ru_date', $timerArray['date'], array('class' => 'form-custom')) }}

                                {{ $errors->first('ru_date', '<div class="alert alert-danger">:message</div>') }}
                            </td>
                        </tr>

                        <tr>

                            <td>
                                {{ Form::label('ru_time', 'Время:') }}
                            </td><td>
                                {{ Form::select('ru_time', $timeArray,  $timerArray['time'], array('class' => 'mydrop')) }}

                                {{ $errors->first('ru_time', '<div class="alert alert-danger">:message</div>') }}
                            </td>
                        </tr>

                        <tr>

                            <td>
                                {{ Form::label('ru_tour_id', 'Тур:') }}
                            </td><td>
                                {{ Form::select('ru_tour_id',$toursArray, $timerArray['tour_id'], array('class' => 'mydrop')) }}

                                {{ $errors->first('ru_tour_id', '<div class="alert alert-danger">:message</div>') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ Form::label('ru_active', 'Статус:') }}</td><td>
                                @if($timerArray['active'] == 1)
                                {{ Form::checkbox('ru_active','1', true)}}
                                @else {{ Form::checkbox('ru_active','1')}}
                                @endif Отображать на сайте


                            </td>
                        </tr>
                    </tbody>
                </table><p><br>
                    {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                {{Form::close()}}
            </div>

        </div>

    </div>
    <!--/span-->

</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-time"></i> Таймер</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <br>

                @if($timerArray['active'] == 1)

                <div id="timer">
                    <p>До тура осталось:</p>			
                    <ul class="countdown">
                        <li class="timernum">
                            <span class="days">0</span>
                            <p class="days_ref">дн.</p>
                        </li>
                        <li class="s">
                            <span class="sep">:</span>                            
                        </li>
                        <li class="timernum">
                            <span class="hours">0</span>
                            <p class="hours_ref">час.</p>
                        </li>
                        <li class="s">
                            <span class="sep">:</span>                            
                        </li>
                         <li class="timernum">
                            <span class="minutes">0</span>
                            <p class="minutes_ref">мин.</p>
                        </li>
                        <li class="s">
                            <span class="sep">:</span>                            
                        </li>
                         <li class="timernum">
                            <span class="seconds">0</span>
                            <p class="seconds_ref">сек.</p>
                        </li>
                    </ul>
                </div><!-- #timer -->
                {{HTML::script('js/jquery.downCount.js')}}

                <!-- Настройка таймера. date: 'месяц/день/год часы:минуты:секунды'. 24-часовой формат. offset: +4 (часовой пояс, Москва +4). -->
                <script class="source" type="text/javascript">
                    $('.countdown').downCount({
                        date: '{{$timerArray["date"]}} {{$timerArray["time"]}}',
                        offset: +3
                    }, function () {
                        $('#timer').css('display', 'none');
                    });
                </script>

                @else
                <p>
                    Таймер не активен</p>

                @endif



            </div>

        </div>

    </div>
    <!--/span-->

</div>



<!-- content ends -->

@stop
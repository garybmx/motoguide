
@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">

    $(document).ready(function () {
    $('#futureTour_link').parent().addClass('active');
            $('input[name="ru_startTime"]').val("{{$tourArray['startTime']}}").minical();
            $('input[name="ru_endTime"]').val("{{$tourArray['endTime']}}").minical();
            $('input[name="en_startTime"]').val("{{$tourArrayEng['startTime']}}").minical();
            $('input[name="en_endTime"]').val("{{$tourArrayEng['endTime']}}").minical();
            $("#markItUp").markItUp(mySettings);
            $("#markItUp2").markItUp(mySettings);
            $("#markItUp3").markItUp(mySettings);
            $("#markItUp4").markItUp(mySettings);
            $("#markItUp5").markItUp(mySettings);
            $("#markItUp6").markItUp(mySettings);
            if ($("div").is("#messageBox")) {
    setTimeout(function () {
    $('#messageBox').fadeOut('slow').remove();
    }, 5000);
    }


    $(document).on("click", "#addprices2", function () {
    num = $('.prices_en').last().attr('num');
            num++;
            $('<table class="prices_ru" num="' + num + '"><tbody><tr><td>Цена ' + num + ':</td><td><table><tr><td>Наименование:&nbsp;</td><td><input name="ru_price_id_' + num + '" type="hidden" value=""><input class="form-custom" size="30%" name="ru_price_name_' + num + '" type="text" value=""></td></tr><tr><td>Стоимость:&nbsp;</td><td><input class="form-custom" size="30%" name="ru_price_price_' + num + '" type="text" value=""></td></tr><tr><td>Описание:&nbsp;</td><td><textarea class="form-custom" name="ru_price_description_' + num + '" cols="50" rows="10"></textarea></td></tr></table></td></tr></tbody></table>').insertAfter($(".prices_ru").last());
            $('<table class="prices_en" num="' + num + '"><tbody><tr><td>Цена ' + num + ' (ENG):</td><td><table><tr><td>Наименование:&nbsp;</td><td><input name="en_price_id_' + num + '" type="hidden" value=""><input class="form-custom" size="30%" name="en_price_name_' + num + '" type="text" value=""></td></tr><tr><td>Стоимость:&nbsp;</td><td><input class="form-custom" size="30%" name="en_price_price_' + num + '" type="text" value=""></td></tr><tr><td>Описание:&nbsp;</td><td><textarea class="form-custom" name="en_price_description_' + num + '" cols="50" rows="10"></textarea></td></tr></table></td></tr></tbody></table>').insertAfter($(".prices_en").last());
            $('input[name="num"]').val(num);
            return false;
    });
            $(document).on("click", "#addprices", function () {
    num = $('.prices_ru').last().attr('num');
            num++;
            $('<table class="prices_ru" num="' + num + '"><tbody><tr><td>Цена ' + num + ':</td><td><table><tr><td>Наименование:&nbsp;</td><td><input name="ru_price_id_' + num + '" type="hidden" value=""><input class="form-custom" size="30%" name="ru_price_name_' + num + '" type="text" value=""></td></tr><tr><td>Стоимость:&nbsp;</td><td><input class="form-custom" size="30%" name="ru_price_price_' + num + '" type="text" value=""></td></tr><tr><td>Описание:&nbsp;</td><td><textarea class="form-custom" name="ru_price_description_' + num + '" cols="50" rows="10"></textarea></td></tr></table></td></tr></tbody></table>').insertAfter($(".prices_ru").last());
            $('<table class="prices_en" num="' + num + '"><tbody><tr><td>Цена ' + num + ' (ENG):</td><td><table><tr><td>Наименование:&nbsp;</td><td><input name="en_price_id_' + num + '" type="hidden" value=""><input class="form-custom" size="30%" name="en_price_name_' + num + '" type="text" value=""></td></tr><tr><td>Стоимость:&nbsp;</td><td><input class="form-custom" size="30%" name="en_price_price_' + num + '" type="text" value=""></td></tr><tr><td>Описание:&nbsp;</td><td><textarea class="form-custom" name="en_price_description_' + num + '" cols="50" rows="10"></textarea></td></tr></table></td></tr></tbody></table>').insertAfter($(".prices_en").last());
            $('input[name="num"]').val(num);
            return false;
    });
    });</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/FutureTour', 'Предстоящие туры')}}
        </li>
        <li>
            {{HTML::link('admin/FutureTour/'. $tourArray['tour_id']. '/edit', 'Редактировать тур')}}
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/FutureTour')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Редактировать предстоящий тур  {{ $tourArray['tour_id'] }}</h2>
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
                        });</script>
                    @endif

                    <ul class="nav nav-tabs" id="myTab"><li>
                            <a href="#rus" id='ru'>Rus</a>
                        </li><li>
                            <a href="#eng" id='en'>Eng</a>    

                        </li>

                    </ul>

                    <div id="myTabContent" class="tab-content">


                        <div class="tab-pane active" id="rus">



                            <p>{{Form::open(array('action' => array('AdminToursController@update', $tourArray['tour_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'ru') }}
                            {{ Form::hidden('tour_id', $tourArray['tour_id']) }}
                              {{ Form::hidden('tourType_id', $tourArray['tourType_id']) }}
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td>
                                            {{ Form::label('ru_name', 'Название тура:') }}
                                        </td><td>
                                            {{ Form::text('ru_name', $tourArray['name'], array('class' => 'form-custom', 'size' => '30%')) }}

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
                                            {{ Form::label('ru_duration', 'Продолжительность тура:') }}</td><td>
                                            {{ Form::text('ru_duration', $tourArray['duration'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('ru_duration', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>


                                    <tr>
                                        <td>
                                            {{ Form::label('ru_description', 'Описание:') }}</td><td>
                                            {{ Form::textarea('ru_description', $tourArray['description'], array('class' => 'form-custom', 'id'=> 'markItUp')) }}

                                            {{ $errors->first('ru_description', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                    <tr>
                                        <td>
                                            {{ Form::label('ru_level_id', 'Уровень:') }}</td><td>

                                            {{ Form::select('ru_level_id', $allLevels, $tourArray['level_id'], array('class' => 'mydrop')) }}

                                            {{ $errors->first('ru_level_id', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>


                                    <tr>
                                        <td>
                                            {{ Form::label('ru_location', 'Место проведения:') }}</td><td>
                                            {{ Form::text('ru_location', $tourArray['location'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('ru_location', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                     <tr>
                                        <td>
                                            {{ Form::label('ru_location', 'Место проведения:') }}</td><td>
                                            {{ Form::text('ru_location', $tourArray['location'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('ru_location', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                     
                                      <tr>
                                        <td>
                                            {{ Form::label('ru_residence', 'Условия проживания:') }}</td><td>
                                            {{ Form::textarea('ru_residence', $tourArray['residence'], array('class' => 'form-custom', 'id'=> 'markItUp2')) }}

                                            {{ $errors->first('ru_residence', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                      
                                       <tr>
                                        <td>
                                            {{ Form::label('ru_feed', 'Питание:') }}</td><td>
                                            {{ Form::textarea('ru_feed', $tourArray['feed'], array('class' => 'form-custom', 'id'=> 'markItUp3')) }}

                                            {{ $errors->first('ru_feed', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                    <tr>
                                        <td>
                                            {{ Form::label('ru_active', 'Статус:') }}</td><td>
                                            @if($tourArray['active'] == 1)
                                            {{ Form::checkbox('ru_active','1', true)}}
                                            @else {{ Form::checkbox('ru_active','1')}}
                                            @endif
                                            Отображать на сайте


                                        </td>
                                    </tr>
                                </tbody>
                            </table><p><br>
                                {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                            {{Form::close()}}
                        </div>
                        <div class="tab-pane" id="eng">
                            <p>{{Form::open(array('action' => array('AdminToursController@update', $tourArrayEng['tour_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'en') }}
                            {{ Form::hidden('tour_id', $tourArrayEng['tour_id']) }}
                              {{ Form::hidden('tourType_id', $tourArray['tourType_id']) }}
                            <table class="mytable "><tbody>
                                    <tr>

                                        <td>
                                            {{ Form::label('en_name', 'Название тура:') }}
                                        </td><td>
                                            {{ Form::text('en_name', $tourArrayEng['name'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_name', '<div class="alert alert-danger">:message</div>') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_startTime', 'Дата начала:') }} 
                                        </td><td><img src="{{'/images/icon_calendar.png'}}">
                                            {{ Form::text('en_startTime', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_startTime', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_endTime', 'Дата окончания:') }}</td><td>
                                            <img src="{{'/images/icon_calendar.png'}}">
                                            {{ Form::text('en_endTime', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_endTime', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>


                                    <tr>
                                        <td>
                                            {{ Form::label('en_duration', 'Продолжительность тура:') }}</td><td>
                                            {{ Form::text('en_duration', $tourArrayEng['duration'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_duration', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>


                                    <tr>
                                        <td>
                                            {{ Form::label('en_description', 'Описание:') }}</td><td>
                                            {{ Form::textarea('en_description', $tourArrayEng['description'], array('class' => 'form-custom', 'id'=> 'markItUp4')) }}

                                            {{ $errors->first('en_description', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                    <tr>
                                        <td>
                                            {{ Form::label('en_level_id', 'Уровень:') }}</td><td>

                                            {{ Form::select('en_level_id', $allLevelsEng, $tourArrayEng['level_id'], array('class' => 'mydrop')) }}

                                            {{ $errors->first('en_level_id', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>


                                    <tr>
                                        <td>
                                            {{ Form::label('en_location', 'Место проведения:') }}</td><td>
                                            {{ Form::text('en_location', $tourArrayEng['location'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_location', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
  <tr>
                                        <td>
                                            {{ Form::label('en_residence', 'Условия проживания:') }}</td><td>
                                            {{ Form::textarea('en_residence', $tourArrayEng['residence'], array('class' => 'form-custom', 'id'=> 'markItUp5')) }}

                                            {{ $errors->first('en_residence', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                      
                                       <tr>
                                        <td>
                                            {{ Form::label('en_feed', 'Питание:') }}</td><td>
                                            {{ Form::textarea('en_feed', $tourArrayEng['feed'], array('class' => 'form-custom', 'id'=> 'markItUp6')) }}

                                            {{ $errors->first('en_feed', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>

                                    <tr>
                                        <td>
                                            {{ Form::label('en_active', 'Статус:') }}</td><td>
                                            @if($tourArrayEng['active'] == 1)
                                            {{ Form::checkbox('en_active','1', true)}}
                                            @else {{ Form::checkbox('en_active','1')}}
                                            @endif
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
    </div>
    <!--/span-->

</div><!--/row-->

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>

            </div>
            <div class="box-content">
                <div class="box-content">
                    @if($errors->has('active1'))
                    <script type="text/javascript">
                                $(document).ready(function () {
                        $('#myTab2 #{{$errors->first('active1')}}').addClass("active");
                                element = $("#myTab2").offset().top;
                            
                        $('body').scrollTop(element);
                       

                        });</script>
                    @else
                    <script type="text/javascript">
                                $(document).ready(function () {
                        $('#myTab2 a:first').addClass("active");
                        });</script>
                    @endif

                    <ul class="nav nav-tabs" id="myTab2"><li>
                            <a href="#rus2" id='ru'>Rus</a>
                        </li><li>
                            <a href="#eng2" id='en'>Eng</a>    

                        </li>

                    </ul>

                    <div id="myTabContent" class="tab-content">
                        {{ $errors->first('error', '<div class="alert alert-danger">:message</div>') }}

                        <div class="tab-pane active" id="rus2">


                            <p>{{Form::open(array('action' => array('AdminToursController@update', $tourArray['tour_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'ru') }}
                            {{ Form::hidden('num', count($prices)) }}
                            {{ Form::hidden('tour_id', $tourArray['tour_id']) }}
                            @foreach($prices as $price)
                            <table class="prices_ru" num="{{$price['num']}}"><tbody>
                                    <tr>

                                        <td>
                                            Цена {{$price['num']}}:<br>
                                            <div class="checkbox">
                                                <label style="color: red">
                                                    {{Form::checkbox('ru_delete_' . $price['num'], $price['num'])}}  Удалить
                                                </label>
                                            </div>
                                        </td><td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Наименование:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::hidden('ru_price_id_'.$price['num'] , $price['price_id']) }}
                                                        {{ Form::text('ru_price_name_' . $price['num'], $price['name'], array('class' => 'form-custom', 'size' => '30%')) }}


                                                    </td>
                                                </tr>    
                                                <tr>
                                                    <td>
                                                        Стоимость:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::text('ru_price_price_' . $price['num'], $price['price'], array('class' => 'form-custom', 'size' => '30%')) }}

                                                        {{ $errors->first('ru_price_price_'. $price['num'], '<div class="alert alert-danger">:message</div>') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Описание:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::textarea('ru_price_description_' . $price['num'], $price['description'], array('class' => 'form-custom')) }}

                                                        {{ $errors->first('ru_price_description', '<div class="alert alert-danger">:message</div>') }}
                                                    </td>
                                                </tr>   

                                            </table>
                                        </td>
                                    </tr>

                                </tbody></table>
                            @endforeach
                            <div>
                                <p><br/>
                                    <a class="btn btn-success" id="addprices" href="">
                                        <i class="glyphicon glyphicon-plus icon-white"></i>
                                        Добавить
                                    </a></p>
                            </div>


                            <p><br>
                                {{Form::submit('Сохранить', array('name'=> 'price_ok', 'class'=>'btn btn-primary'))}}</p>
                            {{Form::close()}}
                        </div>
                        <div class="tab-pane" id="eng2">
                            <p>{{Form::open(array('action' => array('AdminToursController@update', $tourArrayEng['tour_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'en') }}
                            {{ Form::hidden('num', count($pricesEng)) }}
                            {{ Form::hidden('tour_id', $tourArrayEng['tour_id']) }}
                            @foreach($pricesEng as $priceEng)
                            <table class="prices_en" num="{{$priceEng['num']}}"><tbody>
                                    <tr>

                                        <td>
                                            Цена {{$priceEng['num']}} (ENG):<br>
                                            <div class="checkbox">
                                                <label style="color: red">

                                                    {{Form::checkbox('en_delete_' .$priceEng['num'], $priceEng['num'])}} Удалить 
                                                </label>
                                            </div>

                                        </td><td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Наименование:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::hidden('en_price_id_'.$priceEng['num'] , $priceEng['price_id']) }}
                                                        {{ Form::text('en_price_name_' . $priceEng['num'], $priceEng['name'], array('class' => 'form-custom', 'size' => '30%')) }}


                                                    </td>
                                                </tr>    
                                                <tr>
                                                    <td>
                                                        Стоимость:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::text('en_price_price_' . $priceEng['num'], $priceEng['price'], array('class' => 'form-custom', 'size' => '30%')) }}

                                                        {{ $errors->first('en_price_price', '<div class="alert alert-danger">:message</div>') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Описание:&nbsp;
                                                    </td>
                                                    <td>
                                                        {{ Form::textarea('en_price_description_' . $priceEng['num'], $priceEng['description'], array('class' => 'form-custom')) }}

                                                        {{ $errors->first('en_price_description', '<div class="alert alert-danger">:message</div>') }}
                                                    </td>
                                                </tr>   

                                            </table>
                                        </td>
                                    </tr>

                                </tbody></table>
                            @endforeach
                            <div>
                                <p><br/>
                                    <a class="btn btn-success" id="addprices2" href="">
                                        <i class="glyphicon glyphicon-plus icon-white"></i>
                                        Добавить
                                    </a></p>
                            </div>


                            <p><br>
                                {{Form::submit('Сохранить', array('name'=> 'price_ok', 'class'=>'btn btn-primary'))}}</p>
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
                <h2><i class="glyphicon glyphicon-picture"></i> Фотографии</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <br>

                @if(file_exists(base_path() . '\public\images\tours\tour_' . $tourArray['tour_id'] . '.jpeg'))
                <p><img src="{{'/images/tours/tour_' . $tourArray['tour_id'] . '.jpeg?img='. time()}}" class="animated zoomIn"></p>
                {{Form::open(array('action' => array('AdminMotorcyclesController@update', $tourArray['tour_id']), 'method'=>'put', 'id' => 'deleteImage'))}}
                <a class="btn btn-setting btn-success" href="#">
                    <i class="glyphicon glyphicon-share icon-white"></i>
                    Изменить
                </a>
                {{ Form::hidden('deleteImage', $tourArray['tour_id']) }}
                <a class="btn btn-danger" href="#" onclick="document.getElementById('deleteImage').submit();
                                    return false;">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Удалить
                </a>
                {{Form::close()}}
                @else

                <a class="btn btn-setting btn-success" href="#">
                    <i class="glyphicon glyphicon-share icon-white"></i>
                    Добавить
                </a>

                @endif


                <div class="helpbox"><ul>
                        <li>
                            Только файлы формата .jpg или .jpeg
                        </li>
                        <li>
                            Размер изображения должен быть 300x200 пикселей, в противном случае файл будет уменьшен автоматически
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
                {{Form::open(array('action' => array('AdminToursController@update', $tourArray['tour_id']), 'method'=>'put', 'files'=>true))}}
                {{Form::file('motoPhoto', $attributes = array())}}</p>
                {{ Form::hidden('editImage') }}
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



<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-picture"></i> Gallery</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <br>
                <ul class="thumbnails gallery">
                    @forelse($fileArray as $file)

                    <li id="{{$file}}" class="thumbnail">
                        {{Form::open(array('action' => array('AdminToursController@update', $tourArray['tour_id']), 'method'=>'put', 'id' => 'deleteImage_' . $file))}}
                        {{ Form::hidden('deleteImage', $tourArray['tour_id']) }}
                        {{ Form::hidden('deleteImageName', $file) }}
                        {{Form::close()}}     
                        <a style="background:url({{url(). '/images/tours/tour_' . $tourArray['tour_id'] . '/thumbs/'. $file . '?' . time()}})"
                           title="{{$file}}" href="{{url(). '/images/tours/tour_' . $tourArray['tour_id'] . '/'. $file . '?' . time() }}"><img
                                class="grayscale" src="{{url(). '/images/tours/tour_' . $tourArray['tour_id'] . '/thumbs/'. $file. '?' . time() }}"
                                alt="{{$file}}"></a>


                    </li>

                    @empty
                    <p>Нет изображений</p>
                    @endforelse


                </ul>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->



<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Статус тура</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                {{Form::open(array('action' => array('AdminToursController@update', $tourArrayEng['tour_id']), 'method'=>'put', 'onsubmit' => 'return confirm("Изменить статус тура?")'))}}
                  {{ Form::hidden('tour_id', $tourArrayEng['tour_id']) }}
                   {{Form::submit('Перенести в прошедшие', array('name'=> 'change', 'class'=>'btn btn-primary btn-lg'))}}</p>
                            {{Form::close()}}
               
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

@stop
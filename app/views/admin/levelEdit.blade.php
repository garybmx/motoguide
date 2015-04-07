@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/levels', 'Уровни подготовки')}}
        </li>
        <li>
            {{HTML::link('admin/levels/' . $levelArray['level_id'] .'/edit', 'Редактировать уровень подготовки')}}
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
                    
                    $('#levels_link').parent().addClass('active');
                });</script>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/levels')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Редактировать уровень подготовки  {{ $levelArray['level_id'] }}</h2>
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



                            <p>{{Form::open(array('action' => array('AdminLevelsController@update', $levelArray['level_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'ru') }}
                            {{ Form::hidden('level_id', $levelArray['level_id']) }}
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td>
                                            {{ Form::label('ru_name', 'Название уровня:') }}
                                        </td><td>
                                            {{ Form::text('ru_name', $levelArray['name'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('ru_name', '<div class="alert alert-danger">:message</div>') }}
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td>
                                            {{ Form::label('ru_description', 'Описание:') }}</td><td>
                                            {{ Form::textarea('ru_description', $levelArray['description'], array('class' => 'form-custom'))}}

                                            {{ $errors->first('ru_description', '<div class="alert alert-danger">:message</div>') }}
                                        </td></tr>
                                  
                                </tbody>
                            </table><p><br>
                                {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                            {{Form::close()}}
                        </div>
                        <div class="tab-pane" id="eng">
                            <p>{{Form::open(array('action' => array('AdminLevelsController@update', $levelArrayEng['level_id']), 'method'=>'put'))}}</p>
                            {{ Form::hidden('lang', 'en') }}
                            {{ Form::hidden('level_id', $levelArrayEng['level_id']) }}
                            <table class="mytable "><tbody>
                                    <tr>
                                        <td>
                                            {{ Form::label('en_name', 'Название уровня (ENG):') }}
                                        </td><td>
                                            {{ Form::text('en_name', $levelArrayEng['name'], array('class' => 'form-custom', 'size' => '30%')) }}

                                            {{ $errors->first('en_name', '<div class="alert alert-danger">:message</div>') }}
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td>
                                            {{ Form::label('en_description', 'Описание (ENG):') }}</td><td>
                                            {{ Form::textarea('en_description', $levelArrayEng['description'], array('class' => 'form-custom'))}}

                                            {{ $errors->first('en_description', '<div class="alert alert-danger">:message</div>') }}
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








<!-- content ends -->

@stop


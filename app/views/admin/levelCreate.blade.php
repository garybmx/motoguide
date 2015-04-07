@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#levels_link').parent().addClass('active');
    });
   
</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/levels', 'Уровни')}}
        </li>
        <li>
            {{HTML::link('admin/levels/create', 'Добавить уровень')}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Добавить уровень </h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">



                <div id="myTabContent" class="tab-content">


                    <p>{{Form::open(array('action' => array('AdminLevelsController@store'), 'method'=>'post'))}}</p>
                    {{ Form::hidden('lang', 'ru') }}

                    <table class="mytable  "><tbody>
                         

                                <td>
                                    {{ Form::label('ru_name', 'Название уровня:') }}
                                </td><td>
                                    {{ Form::text('ru_name', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_name', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                            
                                <td>
                                    {{ Form::label('ru_description', 'Описание:') }}</td><td>
                                    {{ Form::textarea('ru_description', null, array('class' => 'form-custom'))}}

                                    {{ $errors->first('ru_description', '<div class="alert alert-danger">:message</div>') }}
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
<!--/span-->







<!-- content ends -->

@stop

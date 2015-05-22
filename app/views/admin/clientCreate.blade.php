@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#clients_link').parent().addClass('active');
    });
   
</script>
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/clients', 'Клиенты')}}
        </li>
        <li>
            {{HTML::link('admin/clients/create', 'Добавить клиента')}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Добавить клиента </h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">



                <div id="myTabContent" class="tab-content">


                    <p>{{Form::open(array('action' => array('AdminClientsController@store'), 'method'=>'post'))}}</p>
                    {{ Form::hidden('lang', 'ru') }}

                    <table class="mytable  "><tbody>
                            <tr>

                                <td>
                                    {{ Form::label('ru_name', 'Имя клиента:') }}
                                </td><td>
                                    {{ Form::text('ru_name', null, array('class' => 'form-custom', 'size' => '30%')) }}

                                    {{ $errors->first('ru_name', '<div class="alert alert-danger">:message</div>') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::label('ru_tour_id', 'В каком туре участвовал:') }}</td><td>
                                 
                                    {{ Form::select('ru_tour_id', $pastTours, null, array('class' => 'mydrop')) }}
                                 
                                    {{ $errors->first('ru_tour_id', '<div class="alert alert-danger">:message</div>') }}
                                </td></tr>
                            
                            <tr>
                                <td>
                                    {{ Form::label('ru_review', 'Отзыв:') }}</td><td>
                                    {{ Form::textarea('ru_review', null, array('class' => 'form-custom'))}}

                                    {{ $errors->first('ru_review', '<div class="alert alert-danger">:message</div>') }}
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
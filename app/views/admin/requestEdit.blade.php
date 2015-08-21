@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/request', 'Заявки на участие')}}
        </li>
        <li>
            {{HTML::link('admin/request/' . $requestArray['id'] .'/edit', 'Редактировать заявку')}}
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

        $('#request_link').parent().addClass('active');
    });</script>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/request')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Редактировать заявку на участие  {{ $requestArray['id'] }}</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>

            </div>





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



                    <div id="myTabContent" class="tab-content">

                        <p>{{Form::open(array('action' => array('AdminRequestController@update', $requestArray['id']), 'method'=>'put'))}}</p>

                        {{ Form::hidden('id', $requestArray['id']) }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('name', 'Имя:') }}
                                    </td><td>
                                        {{ Form::text('name', $requestArray['name'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('name', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('lastname', 'Фамилия:') }}
                                    </td><td>
                                        {{ Form::text('lastname', $requestArray['lastname'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('lastname', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('location', 'Город:') }}
                                    </td><td>
                                        {{ Form::text('location', $requestArray['lastname'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('location', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('age', 'Возраст:') }}
                                    </td><td>
                                        {{ Form::text('age', $requestArray['age'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('age', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('phone', 'Телефон:') }}
                                    </td><td>
                                        {{ Form::text('phone', $requestArray['phone'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('phone', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('email', 'Почта:') }}
                                    </td><td>
                                        {{ Form::text('email', $requestArray['email'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('comments', 'Комментарий:') }}</td><td>
                                        {{ Form::textarea('comments', $requestArray['comments'], array('class' => 'form-custom'))}}

                                        {{ $errors->first('comments', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('date', 'Дата заявки:') }}
                                    </td><td>
                                        {{ Form::text('date', $requestArray['date'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('date', '<div class="alert alert-danger">:message</div>') }}
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

</div><!--/row-->








<!-- content ends -->

@stop



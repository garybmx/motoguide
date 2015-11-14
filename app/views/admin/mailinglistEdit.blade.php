@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/mailinglist', 'Почтовая рассылка')}}
        </li>
        <li>
            {{HTML::link('admin/mailinglist/' . $mailinglistArray['id'] .'/edit', 'Редактировать контакт')}}
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

        $('#mailinglist_link').parent().addClass('active');
    });</script>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/mailinglist')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Редактировать контакт подписчика  {{ $mailinglistArray['id'] }}</h2>
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

                        <p>{{Form::open(array('action' => array('AdminMailinglistController@update', $mailinglistArray['id']), 'method'=>'put'))}}</p>

                        {{ Form::hidden('id', $mailinglistArray['id']) }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('email', 'Имя:') }}
                                    </td><td>
                                        {{ Form::text('email', $mailinglistArray['email'], array('class' => 'form-custom', 'size' => '30%')) }}

                                        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                           <tr>
                                        <td>
                                            {{ Form::label('lang', 'Язык:') }}</td><td>

                                            {{ Form::select('lang', $allLang, $mailinglistArray['lang'], array('class' => 'mydrop')) }}

                                            {{ $errors->first('lang', '<div class="alert alert-danger">:message</div>') }}
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

</div><!--/row-->








<!-- content ends -->

@stop



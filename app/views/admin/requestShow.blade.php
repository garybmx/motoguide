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

                 

                     
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('name', 'Имя:') }}
                                    </td><td>
                                     {{$requestArray['name']}}

                                       
                                    </td>
                                </tr>

                               

                               
                                <tr>

                                    <td>
                                        {{ Form::label('tour', 'Тур:') }}
                                    </td><td>
                                        {{ $requestArray['tour'] }}

                                       
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('phone', 'Телефон:') }}
                                    </td><td>
                                        {{ $requestArray['phone'] }}

                                     
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('email', 'Почта:') }}
                                    </td><td>
                                        {{ $requestArray['email'] }}

                                    
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('comment', 'Комментарий:') }}</td><td>
                                        {{ $requestArray['comment']}}

                                       
                                    </td>
                                </tr>

                                <tr>

                                    <td>
                                        {{ Form::label('date', 'Дата заявки:') }}
                                    </td><td>
                                        {{  $requestArray['date'] }}

                                     
                                    </td>
                                </tr>


                            </tbody>
                        </table><p><br>
                     

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->








<!-- content ends -->

@stop



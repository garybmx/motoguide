@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#instructors_link').parent().addClass('active');
    });
   
</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
      <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/instructors', 'Инструктора')}}
        </li>
        <li>
            {{HTML::link('admin/instructors/' . $instructorArray['id'] .'/show', 'Просмотр инструктора' )}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/instructors')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Инструктор {{$instructorArray['id']}}</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">
                <div class="box-content">


                    <ul class="nav nav-tabs" id="myTab"><li>
                            <a href="#rus" class="active" id='ru'>Rus</a>
                        </li><li>
                            <a href="#eng" id='en'>Eng</a>    

                        </li>

                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active" id="rus">
                            <div class="helpbox">

                                @if(file_exists(base_path() . '\public\images\instructors\instructor_' . $instructorArray['id'] . '.jpeg'))
                                <img src="{{'/images/instructors/instructor_' . $instructorArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                            </div>
                          
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Имя:
                                        </td><td >
                                            {{$instructorArray['name'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Фамилия:</td><td>
                                            {{$instructorArray['lastname']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Возраст:</td><td>
                                            {{ $instructorArray['age']}}&nbsp;лет.

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Опыт:</td><td>
                                            {{$instructorArray['expirience']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($instructorArray['active'] == 1)
                                            <span class="label-success label label-default">Активен</span>
                                            @else
                                            <span class="label-default label label-danger">Не активен</span>
                                            @endif



                                        </td>
                                    </tr>
                                </tbody>
                            </table><p><br>
                        </div>
                        <div class="tab-pane" id="eng">
                            <div class="helpbox">

                                @if(file_exists(base_path() . '\public\images\instructors\instructor_' . $instructorArray['id'] . '.jpeg'))
                                <img src="{{'/images/instructors/instructor_' . $instructorArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                                </div>
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180">
                                            Имя:
                                        </td><td width="200">
                                            {{$instructorArrayEng['name'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Фамилия:</td><td>
                                            {{$instructorArrayEng['lastname']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Возраст:</td><td>
                                            {{ $instructorArrayEng['age']}}&nbsp;years.

                                        </td></tr>
                                    <tr>
                                        <td >
                                            Опыт:</td><td>
                                            {{$instructorArrayEng['expirience']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td><td>
                                            @if($instructorArrayEng['active'] == 1)
                                            <span class="label-success label label-default">Активен</span>
                                            @else
                                            <span class="label-default label label-danger">Не активен</span>
                                            @endif


                                        </td>
                                    </tr>
                                </tbody>
                            </table><p><br>
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


@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#motorcycles_link').parent().addClass('active');
    });
   
</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
      <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/motorcycles', 'Мотоциклы')}}
        </li>
        <li>
            {{HTML::link('admin/motorcycles/' . $motorcycleArray['id'] .'/show', 'Просмотр мотоцикла' )}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/motorcycles')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Мотоцикл {{$motorcycleArray['id']}}</h2>
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

                                @if(file_exists(base_path() . '\public\images\motorcycles\motorcycle_' . $motorcycleArray['id'] . '.jpeg'))
                                <img src="{{'/images/motorcycles/motorcycle_' . $motorcycleArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                            </div>
                          
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Название мотоцикла:
                                        </td><td >
                                            {{$motorcycleArray['model'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Мощность:</td><td>
                                            {{$motorcycleArray['power']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Вес:</td><td>
                                            {{ $motorcycleArray['weight']}}&nbsp;кг.

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Описание:</td><td>
                                            {{$motorcycleArray['description']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($motorcycleArray['active'] == 1)
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

                                @if(file_exists(base_path() . '\public\images\motorcycles\motorcycle_' . $motorcycleArray['id'] . '.jpeg'))
                                <img src="{{'/images/motorcycles/motorcycle_' . $motorcycleArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                                </div>
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180">
                                            Название мотоцикла:
                                        </td><td width="200">
                                            {{$motorcycleArrayEng['model'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Мощность:</td><td>
                                            {{$motorcycleArrayEng['power']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Вес:</td><td>
                                            {{ $motorcycleArrayEng['weight']}}&nbsp;кг.

                                        </td></tr>
                                    <tr>
                                        <td >
                                            Описание:</td><td>
                                            {{$motorcycleArrayEng['description']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td><td>
                                            @if($motorcycleArrayEng['active'] == 1)
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


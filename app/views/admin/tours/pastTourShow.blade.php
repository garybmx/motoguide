@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#pastTour_link').parent().addClass('active');
    });

</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/PastTour', 'Прошедшие туры')}}
        </li>
        <li>
            {{HTML::link('admin/PastTour/' . $tourArray['tour_id'], 'Просмотр тура')}}
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/PastTour')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Тур {{$tourArray['tour_id']}}</h2>
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

                                @if(file_exists(base_path() . '\public\images\tours\tour_' . $tourArray['tour_id'] . '.jpeg'))
                                <img src="{{'/images/tours/tours_' . $tourArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                            </div>

                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Название:
                                        </td><td >
                                            {{$tourArray['name'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Начало тура:</td><td>
                                            {{$tourArray['startTime']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Конец тура:</td><td>
                                            {{$tourArray['endTime']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Продолжительность тура:</td><td>
                                            {{$tourArray['duration']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Описание тура:</td><td>
                                            {{$tourArray['description']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Сложность тура:</td><td>
                                            {{$tourArray['level']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Отчет:</td><td>
                                            {{$tourArray['review']}}

                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($tourArray['active'] == 1)
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

                                @if(file_exists(base_path() . '\public\images\tours\tour_' . $tourArray['tour_id'] . '.jpeg'))
                                <img src="{{'/images/tours/tour_' . $tourArray['tour_id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                            </div>
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Название:
                                        </td><td >
                                            {{$tourArrayEng['name'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Начало тура:</td><td>
                                            {{$tourArrayEng['startTime']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Конец тура:</td><td>
                                            {{$tourArrayEng['endTime']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Продолжительность тура:</td><td>
                                            {{$tourArrayEng['duration']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Описание тура:</td><td>
                                            {{$tourArrayEng['description']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Сложность тура:</td><td>
                                            {{$tourArrayEng['level']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Отчет:</td><td>
                                            {{$tourArrayEng['review']}}

                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($tourArrayEng['active'] == 1)
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
                <ul class="thumbnails ">
                    @forelse($fileArray as $file)

                    <li id="{{$file}}" class="thumbnail">
                         
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






<!-- content ends -->

@stop


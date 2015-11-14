@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#blogs_link').parent().addClass('active');
    });
   
</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
      <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/blog', 'Блог')}}
        </li>
        <li>
            {{HTML::link('admin/blog/' . $blogArray['id'] .'/show', 'Просмотр записи' )}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/blog')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Запись {{$blogArray['id']}}</h2>
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

                                @if(file_exists(base_path() . '\public\images\blog\blog_' . $blogArray['id'] . '.jpeg'))
                                <img src="{{'/images/blog/blog_' . $blogArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                            </div>
                          
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Заголовок:
                                        </td><td >
                                            {{$blogArray['header'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Текст:</td><td>
                                            {{$blogArray['text']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Теги:</td><td>
                                            {{ $blogArray['tags']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Дата:</td><td>
                                            {{$blogArray['date']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($blogArray['active'] == 1)
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

                                @if(file_exists(base_path() . '\public\images\blog\blog_' . $blogArray['id'] . '.jpeg'))
                                <img src="{{'/images/blog/blog_' . $blogArray['id'] . '.jpeg?img='. time()}}" class="animated zoomIn">
                                @endif
                                </div>
                            <table class="mytable  "><tbody>
                                      <tr>

                                        <td width="180"  >
                                            Заголовок:
                                        </td><td >
                                            {{$blogArrayEng['header'] }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Текст:</td><td>
                                            {{$blogArrayEng['text']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Теги:</td><td>
                                            {{ $blogArrayEng['tags']}}

                                        </td></tr>
                                    <tr>
                                        <td>
                                            Дата:</td><td>
                                            {{$blogArrayEng['date']}}


                                        </td></tr>
                                    <tr>
                                        <td>Статус:</td>  <td>
                                            @if($blogArray['active'] == 1)
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



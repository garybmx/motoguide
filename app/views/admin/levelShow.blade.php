@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#levels_link').parent().addClass('active');
    });
   
</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
      <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/levels', 'Уровни сложности')}}
        </li>
        <li>
            {{HTML::link('admin/levels/' . $levelArray['level_id'] .'/show', 'Просмотр уровня сложности' )}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/levels')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i> Уровень сложности {{$levelArray['level_id']}}</h2>
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
                          
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180"  >
                                            Название:
                                        </td><td >
                                            {{$levelArray['name'] }}

                                        </td>
                                    </tr>
                                 
                                    <tr>
                                        <td>
                                            Описание:</td><td>
                                            {{$levelArray['description']}}


                                        </td></tr>
                                   
                                </tbody>
                            </table><p><br>
                        </div>
                        <div class="tab-pane" id="eng">
                          
                            <table class="mytable  "><tbody>
                                    <tr>

                                        <td width="180">
                                            Название (ENG):
                                        </td><td width="200">
                                            {{$levelArrayEng['name'] }}

                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td >
                                            Описание (ENG):</td><td>
                                            {{$levelArrayEng['description']}}


                                        </td></tr>
                                   
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


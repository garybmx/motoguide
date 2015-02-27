@extends('admin.layouts.base')

@section('admin.body')   

<!-- content starts -->
<div>
    <ul class="breadcrumb">
         <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/motorcycles', 'Мотоциклы')}}
        </li>
      
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Мотоциклы</h2>


            </div>
            <div class="box-content">
                <div class="alert alert-info">Добавить новый мотоцикл:&nbsp;&nbsp;<a class="btn  btn-success" href="motorcycles/create">
                        <i class="glyphicon glyphicon-share icon-white"></i>
                        Добавить
                    </a>

                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        if($("div").is("#messageBox")){
                        setTimeout(function () {
                            $('#messageBox').fadeOut('slow')
                        }, 5000);
                        }        
                    });</script>
                @if($errors->has('notdone') || $errors->has('model'))

                <div class="alert alert-danger" id="messageBox">
                    {{$errors->first()}}
                </div>
                @endif
                @if($errors->has('done'))
                <div class="alert alert-success" id="messageBox">
                    {{$errors->first('done')}}
                </div>
                @endif
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Мотоцикл</th>
                            <th>Описание</th>
                            <th>Статус RUS</th>
                            <th>Статус ENG</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allMotorcycles as $id => $motorcycle)
                        <tr>
                            <td class="center">{{$motorcycle['id']}}</td>
                            <td>{{$motorcycle['model']}}</td>
                            <td class="center">
                                @if($allMotorcyclesEng[$id]['description'] == '' || $motorcycle['description'] == '')
                                Неполное
                                @else 
                                Полное
                                @endif
                            </td>
                            <td class="center">
                                @if($motorcycle['active'] == 1)
                                <span class="label-success label label-default">Активен</span>
                                @else
                                <span class="label-default label label-danger">Не активен</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($allMotorcyclesEng[$id]['active'] == 1)
                                <span class="label-success label label-default">Активен</span>
                                @else
                                <span class="label-default label label-danger">Не активен</span>
                                @endif
                            </td>
                            <td class="center">
                                {{Form::open(array('action' => array('AdminMotorcyclesController@destroy', $motorcycle['id'] ), 'method' => 'delete' ))}}
                                <a class="btn btn-success" href="/admin/motorcycles/{{$motorcycle['id']}}">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Просмотреть
                                </a>
                                <a class="btn btn-info" href="/admin/motorcycles/{{$motorcycle['id']}}/edit">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Редактировать
                                </a>

                                <button type="submit" class="btn btn-danger displayBut"> 
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Удалить
                                </button>
                                {{Form::close()}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->



<!-- content ends -->
@stop



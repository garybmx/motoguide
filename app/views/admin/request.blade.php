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

    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Заявки на участие</h2>


            </div>
            <div class="box-content">

                <script type="text/javascript">
                    $(document).ready(function () {
                        if ($("div").is("#messageBox")) {
                            setTimeout(function () {
                                $('#messageBox').fadeOut('slow')
                            }, 5000);
                        }
                    });</script>
                @if($errors->has('notdone'))

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
                            <th>Имя</th>                           
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allRequests as $id => $request)
                        <tr>
                            <td class="center">{{$request['id']}}</td>
                            <td>{{$request['name']}}</td>                   
                            <td>{{date('d-m-Y',time($request['date']))}}</td>
                            <td class="center">
                                @if($request['new'] == 1)
                                <span class="label-success label label-default">Новый</span>

                                @endif
                            </td>

                            <td class="center">
                                {{Form::open(array('action' => array('AdminRequestController@destroy', $request['id'] ), 'method' => 'delete' ))}}
                                <a class="btn btn-success" href="/admin/request/{{$request['id']}}">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Просмотреть
                                </a>
                                <a class="btn btn-info" href="/admin/request/{{$request['id']}}/edit">
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



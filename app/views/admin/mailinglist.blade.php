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

    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Почтовая рассылка</h2>


            </div>
            <div class="box-content">
                <div class="alert alert-info">Добавить новый email:&nbsp;&nbsp;<a class="btn  btn-success" href="mailinglist/create">
                        <i class="glyphicon glyphicon-share icon-white"></i>
                        Добавить
                    </a>

                </div>
               
                <div class="well-large">
                    <a class="btn  btn-primary" href="mailinglist/1">
                        <i class="glyphicon glyphicon-envelope icon-white"></i>
                        Формировать русскую рассылку 
                    </a>
                    <a class="btn  btn-primary" href="mailinglist/0">
                        <i class="glyphicon glyphicon-envelope icon-white"></i>
                        Формировать английскую рассылку 
                    </a>

                </div>
                <br>


                <script type="text/javascript">
                    $(document).ready(function () {
                        if ($("div").is("#messageBox")) {
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
                            <th>Email</th>
                            <th>Язык</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allMailinglists as $id => $mailinglist)
                        <tr>
                            <td class="center">{{$mailinglist['id']}}</td>
                            <td>{{$mailinglist['email']}}</td>
                            <td>
                                @if($mailinglist['lang'] == 1)
                                <span>ru</span>
                                @else
                                <span">en</span>
                                @endif
                            </td>

                            <td class="center">
                                {{Form::open(array('action' => array('AdminMailinglistController@destroy', $mailinglist['id'] ), 'method' => 'delete' ))}}

                                <a class="btn btn-info" href="/admin/mailinglist/{{$mailinglist['id']}}/edit">
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



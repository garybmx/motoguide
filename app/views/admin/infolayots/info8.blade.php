
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Редактировать видео:</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                </div>

            </div>


     



            @if($errors->has('notdone_video_1'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('notdone_video_1')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_8').removeAttr('style');
                    });</script>
            </div>
            @endif
            @if($errors->has('done_video_1'))
            <div class="alert alert-success" id="messageBox">
                {{$errors->first('done_video_1')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_8').removeAttr('style');
                    });</script>
            </div>

            @endif

            <div class="box-content" style="display: none" id="box_content_8">

                @if($errors->has('active'))
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab8 #{{$errors->first('active')}}').addClass("active");
                    });</script>
                @else
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab8 a:first').addClass("active");
                    });</script>
                @endif

                <ul class="nav nav-tabs" id="myTab8"><li>
                        <a href="#rus8" id='ru'>Rus</a>
                    </li><li>
                        <a href="#eng8" id='en'>Eng</a>    

                    </li>

                </ul>

                <div id="myTabContent" class="tab-content">


                    <div class="tab-pane active" id="rus8">



                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'ru') }}
                        {{ Form::hidden('type', 'video') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('ru_text', 'Ссылка на видео:') }}
                                    </td><td>
                                        {{ Form::text('ru_text', $informationArray['video_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('ru_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                               


                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="eng8">
                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'en') }}
                        {{ Form::hidden('type', 'video') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable "><tbody>
                                <tr>
                                    <td>
                                        {{ Form::label('en_text', 'Ссылка на видео (ENG):') }}
                                    </td><td>
                                        {{ Form::text('en_text', $informationArrayEng['video_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('en_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                             


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


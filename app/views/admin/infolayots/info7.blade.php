<script type="text/javascript">

    $(document).ready(function () {

        $("#markItUp").markItUp(mySettings);
          $("#markItUp2").markItUp(mySettings);
    });</script>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Редактировать блок "о нас":</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                </div>

            </div>






            @if($errors->has('notdone_about_1'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('notdone_about_1')}}
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#box_content_7').removeAttr('style');
                    });</script>
            </div>
            @endif
            @if($errors->has('done_about_1'))
            <div class="alert alert-success" id="messageBox">
                {{$errors->first('done_about_1')}}
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#box_content_7').removeAttr('style');
                    });</script>
            </div>

            @endif

            <div class="box-content" style="display: none" id="box_content_7">

                @if($errors->has('active'))
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#myTab7 #{{$errors->first('active')}}').addClass("active");
                    });</script>
                @else
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#myTab7 a:first').addClass("active");
                    });</script>
                @endif

                <ul class="nav nav-tabs" id="myTab7"><li>
                        <a href="#rus7" id='ru'>Rus</a>
                    </li><li>
                        <a href="#eng7" id='en'>Eng</a>    

                    </li>

                </ul>

                <div id="myTabContent" class="tab-content">


                    <div class="tab-pane active" id="rus7">



                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'ru') }}
                        {{ Form::hidden('type', 'about') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('ru_text', 'Информация:') }}
                                    </td><td>
                                        {{ Form::textarea('ru_text', $informationArray['about_1'], array('class' => 'form-custom', 'id'=> 'markItUp'))}}

                                        {{ $errors->first('ru_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>



                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="eng7">
                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'en') }}
                        {{ Form::hidden('type', 'about') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable "><tbody>
                                <tr>
                                    <td>
                                        {{ Form::label('en_text', 'Информация (ENG):') }}
                                    </td><td>
                                        {{ Form::textarea('en_text', $informationArrayEng['about_1'], array('class' => 'form-custom', 'id'=> 'markItUp2'))}}

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



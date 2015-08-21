
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Редактировать инфоблок 1:</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                </div>

            </div>


            @if($errors->has('image'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('image')}}
            </div>
            @endif



            @if($errors->has('notdone_info_1'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('notdone_info_1')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_4').removeAttr('style');
                    });</script>
            </div>
            @endif
            @if($errors->has('done_info_1'))
            <div class="alert alert-success" id="messageBox">
                {{$errors->first('done_info_1')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_4').removeAttr('style');
                    });</script>
            </div>

            @endif

            <div class="box-content" style="display: none" id="box_content_4">

                @if($errors->has('active'))
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab4 #{{$errors->first('active')}}').addClass("active");
                    });</script>
                @else
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab4 a:first').addClass("active");
                    });</script>
                @endif

                <ul class="nav nav-tabs" id="myTab4"><li>
                        <a href="#rus4" id='ru'>Rus</a>
                    </li><li>
                        <a href="#eng4" id='en'>Eng</a>    

                    </li>

                </ul>

                <div id="myTabContent" class="tab-content">


                    <div class="tab-pane active" id="rus4">



                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'ru') }}
                        {{ Form::hidden('type', 'info') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('ru_head', 'Заголовок:') }}
                                    </td><td>
                                        {{ Form::text('ru_head', $informationArray['info_head_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('ru_head', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ Form::label('ru_text', 'Текст:') }}</td><td>
                                        {{ Form::text('ru_text', $informationArray['info_text_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('ru_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td></tr>
                                <tr>


                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="eng4">
                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'en') }}
                        {{ Form::hidden('type', 'info') }}
                        {{ Form::hidden('number', '1') }}
                        <table class="mytable "><tbody>
                                <tr>
                                    <td>
                                        {{ Form::label('en_head', 'Заголовок (ENG):') }}
                                    </td><td>
                                        {{ Form::text('en_head', $informationArrayEng['info_head_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('en_head', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ Form::label('en_text', 'Текст (ENG):') }}</td><td>
                                        {{ Form::text('en_text', $informationArrayEng['info_text_1'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('en_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td></tr>


                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>

                </div>



                <br>

                @if(file_exists(base_path() . '\public\images\informations\info_1.jpeg'))
                <p><img src="{{'/images/informations/info_1.jpeg?img='. time()}}" class="animated zoomIn"></p>
                {{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put', 'id' => 'deleteImage4'))}}
                <br>
                {{ Form::hidden('deleteImage', '1') }}
                  {{ Form::hidden('number', '1') }}
                {{ Form::hidden('type', 'info') }}

                <a class="btn btn-danger" href="#" onclick="document.getElementById('deleteImage4').submit();
                                    return false;">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Удалить
                </a>
                {{Form::close()}}
                @else
                <p>
                    Изображение не загружено</p>
                <hr>
                <div class="modal-body">
                    {{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put', 'files'=>true))}}
                    {{ Form::hidden('number', '1') }}
                    {{ Form::hidden('type', 'info') }}
                    {{Form::file('motoPhoto', $attributes = array())}}</p>
                <br>
                    {{Form::submit('Загрузить', array('name'=> 'photo', 'class'=>'btn btn-primary'))}}
                </div>


                {{Form::close()}}


                @endif


                <div class="helpbox"><ul>
                        <li>
                            Только файлы формата .jpeg или .jpeg
                        </li>
                        <li>
                            Размер изображения должен быть 640x480 пикселей, в противном случае файл будет уменьшен автоматически
                        </li>
                        <li>
                            Если изображение уже существует, то новое изображение заменит старое
                        </li>
                    </ul>
                </div>




            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->




<!-- content ends -->


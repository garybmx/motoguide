
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Редактировать Баннер 3:</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-down"></i></a>
                </div>

            </div>


          



            @if($errors->has('notdone_banner_3'))

            <div class="alert alert-danger" id="messageBox">
                {{$errors->first('notdone_banner_3')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_3').removeAttr('style');
                    });</script>
            </div>
            @endif
            @if($errors->has('done_banner_3'))
            <div class="alert alert-success" id="messageBox">
                {{$errors->first('done_banner_3')}}
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#box_content_3').removeAttr('style');
                    });</script>
            </div>

            @endif

            <div class="box-content" style="display: none" id="box_content_3">

                @if($errors->has('active'))
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab3 #{{$errors->first('active')}}').addClass("active");
                    });</script>
                @else
                <script type="text/javascript">
                            $(document).ready(function () {
                    $('#myTab3 a:first').addClass("active");
                    });</script>
                @endif

                <ul class="nav nav-tabs" id="myTab3"><li>
                        <a href="#rus3" id='ru'>Rus</a>
                    </li><li>
                        <a href="#eng3" id='en'>Eng</a>    

                    </li>

                </ul>

                <div id="myTabContent" class="tab-content">


                    <div class="tab-pane active" id="rus3">



                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'ru') }}
                        {{ Form::hidden('type', 'banner') }}
                        {{ Form::hidden('number', '3') }}
                        <table class="mytable  "><tbody>
                                <tr>

                                    <td>
                                        {{ Form::label('ru_head', 'Заголовок:') }}
                                    </td><td>
                                        {{ Form::text('ru_head', $informationArray['banner_head_3'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('ru_head', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ Form::label('ru_text', 'Текст:') }}</td><td>
                                        {{ Form::text('ru_text', $informationArray['banner_text_3'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('ru_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td></tr>
                                <tr>


                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="eng3">
                        <p>{{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put'))}}</p>
                        {{ Form::hidden('lang', 'en') }}
                        {{ Form::hidden('type', 'banner') }}
                        {{ Form::hidden('number', '3') }}
                        <table class="mytable "><tbody>
                                <tr>
                                    <td>
                                        {{ Form::label('en_head', 'Заголовок (ENG):') }}
                                    </td><td>
                                        {{ Form::text('en_head', $informationArrayEng['banner_head_3'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('en_head', '<div class="alert alert-danger">:message</div>') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ Form::label('en_text', 'Текст (ENG):') }}</td><td>
                                        {{ Form::text('en_text', $informationArrayEng['banner_text_3'], array('class' => 'form-custom', 'size' => '90%')) }}

                                        {{ $errors->first('en_text', '<div class="alert alert-danger">:message</div>') }}
                                    </td></tr>


                            </tbody>
                        </table><p><br>
                            {{Form::submit('Сохранить', array('name'=> 'ok', 'class'=>'btn btn-primary'))}}</p>
                        {{Form::close()}}
                    </div>

                </div>



                <br>

                @if(file_exists(base_path() . '\public\images\informations\banner_3.png'))
                <p><img src="{{'/images/informations/banner_3.png?img='. time()}}" class="animated zoomIn"></p>
                {{Form::open(array('action' => array('AdminInformationController@update'), 'method'=>'put', 'id' => 'deleteImage3'))}}
                <br>
                {{ Form::hidden('deleteImage', '3') }}
                  {{ Form::hidden('number', '3') }}
                {{ Form::hidden('type', 'banner') }}

                <a class="btn btn-danger" href="#" onclick="document.getElementById('deleteImage3').submit();
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
                    {{ Form::hidden('number', '3') }}
                    {{ Form::hidden('type', 'banner') }}
                    {{Form::file('motoPhoto', $attributes = array())}}</p>
                <br>
                    {{Form::submit('Загрузить', array('name'=> 'photo', 'class'=>'btn btn-primary'))}}
                </div>


                {{Form::close()}}


                @endif


                <div class="helpbox"><ul>
                        <li>
                            Только файлы формата .png
                        </li>
                        <li>
                            Размер изображения должен быть 480x328 пикселей, в противном случае файл будет уменьшен автоматически
                        </li>
                     
                    </ul>
                </div>




            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->




<!-- content ends -->



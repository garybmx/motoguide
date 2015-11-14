@extends('admin.layouts.base')

@section('admin.body')   
<script type="text/javascript">
    $(document).ready(function () {
        $('#mailinglists_link').parent().addClass('active');
    });

</script>
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/mailinglist', 'Почтовая рассылка')}}
        </li>
        <li>
            {{HTML::link('admin/mailinglist/' . Request::segment(3) .'/show', 'Сформировать список рассылки' )}}
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><a href="{{URL::to('/admin/mailinglist')}}"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Назад</a>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-envelope"></i>  @if(Request::segment(3) == 1)
                    Русская
                    @else
                    Английская
                    @endif рассылка</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>

            </div>
            <div class="box-content">
                <div class="box-content">

                    {{ Form::textarea('emails',$mailinglistString, array('class' => 'form-custom', 'cols'=>'100'))}}

                </div>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->








<!-- content ends -->

@stop



@extends('admin.layouts.base')

@section('admin.body')   
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            {{HTML::link('/admin', 'Главная')}}

        </li>
        <li>
            {{HTML::link('admin/informations', 'Информация главной страницы')}}
        </li>

    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    if ($("div").is("#messageBox")) {
    setTimeout(function () {
    $('#messageBox').fadeOut('slow').remove();
    }, 1000);
    }

    $('#informations_link').parent().addClass('active');
    });</script>



@include('admin.infolayots.info1')
@include('admin.infolayots.info2')
@include('admin.infolayots.info3')
@include('admin.infolayots.info4')
@include('admin.infolayots.info5')
@include('admin.infolayots.info6')
@include('admin.infolayots.info7')
@include('admin.infolayots.info8')
<!-- content ends -->

@stop
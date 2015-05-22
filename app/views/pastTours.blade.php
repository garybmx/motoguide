@extends('layouts.base')

@section('admin.body')

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="color-green pull-left">Portfolio 2 Columns</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="portfolio.html">Portfolio</a> <span class="divider">/</span></li>
            <li class="active">Portfolio 2 Columns</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container portfolio-columns"> 	
    <div class="row-fluid"> 
        <div class="view view-tenth span6">
        	<img src="{{ URL::to('/')}}/assets/img/carousel/1.jpg" alt="" />
            <div class="mask">
                <h2>Portfolio Item</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                <a href="portfolio_item.html" class="info">Read More</a>
            </div>
        </div>
        <div class="view view-tenth span6">
        	<img src="{{ URL::to('/')}}/assets/img/carousel/2.jpg" alt="" />
            <div class="mask">
                <h2>Portfolio Item</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                <a href="portfolio_item.html" class="info">Read More</a>
            </div>
        </div>
    </div><!--/row-fluid-->

    <div class="row-fluid"> 
        <div class="view view-tenth span6">
        	<img src="{{ URL::to('/')}}/assets/img/carousel/3.jpg" alt="" />
            <div class="mask">
                <h2>Portfolio Item</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                <a href="portfolio_item.html" class="info">Read More</a>
            </div>
        </div>
        <div class="view view-tenth span6">
        	<img src="{{ URL::to('/')}}/assets/img/carousel/4.jpg" alt="" />
            <div class="mask">
                <h2>Portfolio Item</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                <a href="portfolio_item.html" class="info">Read More</a>
            </div>
        </div>
    </div><!--/row-fluid-->
</div><!--/container-->
<!--=== End Content Part ===-->
@stop
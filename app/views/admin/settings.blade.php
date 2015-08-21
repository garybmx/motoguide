@extends('admin.layouts.base')

@section('admin.body')
  <div>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">Главная</a>
                            </li>
                          
                        </ul>
                    </div>
                    <div class=" row">
                       


                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
                                <i class="glyphicon glyphicon-shopping-cart yellow"></i>

                                <div>Подписки</div>
                                <div>3</div>
                                <span class="notification yellow">$34</span>
                            </a>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
                                <i class="glyphicon glyphicon-envelope red"></i>

                                <div>Заявки</div>
                                <div>25</div>
                                <span class="notification red">12</span>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="box col-md-12">
                            <div class="box-inner">
                                <div class="box-header well">
                                    <h2><i class="glyphicon glyphicon-info-sign"></i> Добро пожаловать!</h2>

                                    <div class="box-icon">
                                       
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                                class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content row">
                                    <div class="col-lg-7 col-md-12">
                                        <h1>Панель администратора Enduro Tour  <br>
                                            
                                        </h1>
                                        <p>Все страницы сайта кэшируются. Поэтому, после любых изменений в панели администратора,<br>
                                            необходимо обязательно нажать кнопку <b>"обновить кэш"</b>. <br>
                                            В противном случае кэш обновится автоматически спустя сутки.
                                        </p><br>


                                        <p class="center-block download-buttons">
                                            <a href="{{HTML::entities('/');}}" class="btn btn-primary btn-lg"><i
                                                    class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Вернуться на сайт</a>
                                            <a href="{{HTML::entities('/');}}" class="btn btn-default btn-lg"><i
                                                    class="glyphicon glyphicon-download-alt"></i> Обновить кэш</a>
                                        </p>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--/span-->

                        <div class="box col-md-4">
                            <div class="box-inner">
                                <div class="box-header well" data-original-title="">
                                    <h2><i class="glyphicon glyphicon-list"></i> Статистика за неделю</h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                                class="glyphicon glyphicon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                                class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <ul class="dashboard-list">
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-arrow-up"></i>
                                                <span class="green">92</span>
                                                New Comments
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                                <span class="red">15</span>
                                                New Registrations
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-minus"></i>
                                                <span class="blue">36</span>
                                                New Articles
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-comment"></i>
                                                <span class="yellow">45</span>
                                                User reviews
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-arrow-up"></i>
                                                <span class="green">112</span>
                                                New Comments
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                                <span class="red">31</span>
                                                New Registrations
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-minus"></i>
                                                <span class="blue">93</span>
                                                New Articles
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-comment"></i>
                                                <span class="yellow">254</span>
                                                User reviews
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/span-->

                        <div class="box col-md-4">
                            <div class="box-inner homepage-box">
                                <div class="box-header well">
                                    <h2><i class="glyphicon glyphicon-th"></i> Заявки</h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                                class="glyphicon glyphicon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                                class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#info">Info</a></li>
                                        <li><a href="#custom">Custom</a></li>
                                        <li><a href="#messages">Messages</a></li>
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">
                                            <h3>Charisma
                                                <small>a full featured template</small>
                                            </h3>
                                            <p>Its a full featured, responsive template for your admin panel. It is optimized for tablets
                                                and mobile phones.</p>

                                            <p>Check how it looks on different devices:</p>
                                            <a href="http://www.responsinator.com/?url=usman.it%2Fthemes%2Fcharisma"
                                               target="_blank"><strong>Preview on iPhone size.</strong></a>
                                            <br>
                                            <a href="http://www.responsinator.com/?url=usman.it%2Fthemes%2Fcharisma"
                                               target="_blank"><strong>Preview on iPad size.</strong></a>
                                        </div>
                                        <div class="tab-pane" id="custom">
                                            <h3>Custom
                                                <small>small text</small>
                                            </h3>
                                            <p>Sample paragraph.</p>

                                            <p>Your custom text.</p>
                                        </div>
                                        <div class="tab-pane" id="messages">
                                            <h3>Messages
                                                <small>small text</small>
                                            </h3>
                                            <p>Sample paragraph.</p>

                                            <p>Your custom text.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->

                        <div class="box col-md-4">
                            <div class="box-inner">
                                <div class="box-header well" data-original-title="">
                                    <h2><i class="glyphicon glyphicon-user"></i> Заявки</h2>

                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                                class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="box-content">
                                        <ul class="dashboard-list">
                                            <li>
                                                <strong>Имя:</strong> <a href="#">Usman
                                                </a><br>
                                                <strong>Город:</strong> 17/05/2014<br>
                                                <strong>Дата заявки:</strong> 17/05/2014<br>
                                            </li>
                                            <li>
                                                <strong>Имя:</strong> <a href="#">Usman
                                                </a><br>
                                                <strong>Город:</strong> 17/05/2014<br>
                                                <strong>Дата заявки:</strong> 17/05/2014<br>
                                            </li>
                                            <li>
                                                <strong>Имя:</strong> <a href="#">Usman
                                                </a><br>
                                                <strong>Город:</strong> 17/05/2014<br>
                                                <strong>Дата заявки:</strong> 17/05/2014<br>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->


                    </div><!--/row-->

                    <!-- content ends -->
                    
                    @stop
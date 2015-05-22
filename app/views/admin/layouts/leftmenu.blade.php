
<!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Настройки сайта</li>
                        <li><a class="ajax-link" href="index.html" id="information_link"><i class="glyphicon glyphicon-info-sign"></i><span> Информация</span></a>
                        </li>
                        <li><a class="ajax-link" href="ui.html" id="preference_link"><i class="glyphicon  glyphicon-cog"></i><span> Настройки</span></a>
                        </li>
                      
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/motorcycles');}}" id="motorcycles_link"><i class="glyphicon glyphicon-list-alt"></i><span> Мотоциклы</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/instructors');}}" id="instructors_link"><i class="glyphicon glyphicon-user"></i><span> Инструктора</span></a>
                        </li>
                        
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/clients');}}" id="clients_link"><i class="glyphicon glyphicon-user"></i><span> Клиенты</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/contacts');}}"><i
                                    class="glyphicon glyphicon-envelope"></i><span> Контакты</span></a></li>
                        <li class="nav-header hidden-md">События</li>
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/timer');}}"><i
                                    class="glyphicon glyphicon-time"></i><span>Таймер</span></a></li>
                       
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Туры</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{HTML::entities('/admin/PastTour');}}" id="pastTour_link">Прошедшие</a></li>
                                <li><a href="{{HTML::entities('/admin/FutureTour');}}" id="futureTour_link">Предстоящие</a></li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="{{HTML::entities('/admin/levels');}}" id="levels_link"><i
                                    class="glyphicon glyphicon-signal"></i><span> Уровни сложности</span></a></li>
                       
                      
                    </ul>
                   
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

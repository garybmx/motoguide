@extends('layouts.base')

@section('admin.body')
<div class="slider-inner">
    <div id="da-slider" class="da-slider">
        <div class="da-slide">
            <h2><i>Техника</i> <br /> <i>КТМ</i></h2>
            <p><i>Только подготовленные</i> <br /> <i>Мотоциклы КТМ</i> <br /> <i>Готовые к любым испытаниям </i></p>
            <div class="da-img"><img src="assets/plugins/parallax-slider/img/1.png" alt="" /></div>
        </div>
        <div class="da-slide">
            <h2><i>Живописные</i> <br /> <i>маршруты</i></h2>
            <p><i>Болгария удивительно</i> <br /> <i>красивая страна</i> <br /> <i>с незабываемыми пейзажами </i></p>
            <div class="da-img"><img src="assets/plugins/parallax-slider/img/1.png" alt="" /></div>
        </div>
        <div class="da-slide">
            <h2><i>Опытные</i> <br /> <i>инструктора</i></h2>
            <p><i>Поднимите свой уровень</i> <br /> <i>владения мотоциклом</i> <br /> <i>на несколько ступеней </i></p>
            <div class="da-img"><img src="assets/plugins/parallax-slider/img/1.png" alt="" /></div>
        </div>
        <nav class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>        
        </nav>
    </div><!--/da-slider-->
</div><!--/slider-->
<!--=== End Slider ===-->

<!-- Purchase Block -->
<div class="row-fluid purchase margin-bottom-30">
    <div class="container">
        <div class="span9">
            <span>До следующего тура осталось:</span>
            <p>9:00.00</p>
        </div>
        <a href="https://wrapbootstrap.com/theme/unify-responsive-website-template-WB0412697" class="btn-buy hover-effect">Записаться сейчас</a>
    </div>
</div><!--/row-fluid-->
<!-- End Purchase Block -->

<!--=== Content Part ===-->
<div class="container">		
    <!-- Service Blocks -->
    <div class="row-fluid servive-block">
        <div class="span4">
            <h4>Различные категории сложности</h4>
            <p><i class="icon-bell"></i></p>
            <p>В наших турах может участвовать человек любого уровня подготовки</p>
        </div>
        <div class="span4">
            <h4>Все включено</h4>
            <p><i class="icon-bullhorn"></i></p>
            <p>Экипировка, проживание и питание входит в стоимость тура.</p>
        </div>
        <div class="span4">
            <h4>Возьми с собой семью</h4>
            <p><i class="icon-lightbulb"></i></p>
            <p>Жена не пускает одного? Возьми ее с собой.</p>
        </div>
    </div><!--/row-fluid-->
    <!-- //End Service Blokcs -->

    <!-- About Us -->
    <div class="headline"><h3>О нас:</h3></div>
    <div class="row-fluid margin-bottom-30">
        <div class="span6">
            <p>Мы занимаемся мото-турами на протяжении нескольких лет. 
                Все наши инструкторы- профессионалы, за плечами которых участие во многих соревнованиях, а также годы преподавания в мотошколах. Наша школа предлагает: </p>
            <ul class="unstyled">
                <li><i class="icon-ok color-green"></i> Подготовленные мотоциклы</li>
                <li><i class="icon-ok color-green"></i> Хорошую экипировку</li>
                <li><i class="icon-ok color-green"></i> Обучение</li>
                <li><i class="icon-ok color-green"></i> Проживание</li>
                <li><i class="icon-ok color-green"></i> Питание</li>
                <li><i class="icon-ok color-green"></i> Девочки, баня</li>
            </ul><br />
            <p>Наши клиенты становятся нашими друзьями!</p>
            <!-- Blockquotes -->
            <blockquote>                        
                <p>Участвовал в мототуре "морское побережье". Очень понравилось.</p>
                <small>Иван Иванов</small>
            </blockquote>
            <blockquote>                        
                <p>Получил незабываемые впечатления ! </p>
                <small>Иванов Илья</small>
            </blockquote>
        </div>
        <div class="span6">
            <iframe src="http://player.vimeo.com/video/9679622" width="100%" height="327" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> 
        </div>
    </div><!--/row-fluid-->	
    <!--//End About Us -->

    <!-- Recent Works -->
    <div class="headline"><h3>Прошедшие туры</h3></div>
    <div class="row-fluid margin-bottom-40">
        <ul id="list" class="bxslider recent-work">
            <li>
                <a href="#">
                    <em class="overflow-hidden"><img src="assets/img/carousel/2.jpg" alt="" /></em>
                    <span>
                        <strong>Морское побережье</strong>
                        <i>дата проведения: 2014-2015</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <em class="overflow-hidden"><img src="assets/img/carousel/2.jpg" alt="" /></em>
                    <span>
                        <strong>Другое побережье</strong>
                        <i>дата проведения: 2014-2015</i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <em class="overflow-hidden"><img src="assets/img/carousel/2.jpg" alt="" /></em>
                    <span>
                        <strong>Морское побережье</strong>
                        <i>дата проведения: 2014-2015</i>
                    </span>
                </a>
            </li>
        </ul>        
    </div><!--/row-->
    <!-- //End Recent Works -->


    <!-- Our Clients -->
    <div id="clients-flexslider" class="flexslider home clients">

        <ul class="slides">
            <li>
                <a href="#">
                    <img src="assets/img/clients/hp_grey.png" alt="" /> 
                    <img src="assets/img/clients/hp.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/igneus_grey.png" alt="" /> 
                    <img src="assets/img/clients/igneus.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/vadafone_grey.png" alt="" /> 
                    <img src="assets/img/clients/vadafone.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/walmart_grey.png" alt="" /> 
                    <img src="assets/img/clients/walmart.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/shell_grey.png" alt="" /> 
                    <img src="assets/img/clients/shell.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/natural_grey.png" alt="" /> 
                    <img src="assets/img/clients/natural.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/aztec_grey.png" alt="" /> 
                    <img src="assets/img/clients/aztec.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/gamescast_grey.png" alt="" /> 
                    <img src="assets/img/clients/gamescast.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/cisco_grey.png" alt="" /> 
                    <img src="assets/img/clients/cisco.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/everyday_grey.png" alt="" /> 
                    <img src="assets/img/clients/everyday.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/cocacola_grey.png" alt="" /> 
                    <img src="assets/img/clients/cocacola.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/spinworkx_grey.png" alt="" /> 
                    <img src="assets/img/clients/spinworkx.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/shell_grey.png" alt="" /> 
                    <img src="assets/img/clients/shell.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/natural_grey.png" alt="" /> 
                    <img src="assets/img/clients/natural.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/gamescast_grey.png" alt="" /> 
                    <img src="assets/img/clients/gamescast.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/everyday_grey.png" alt="" /> 
                    <img src="assets/img/clients/everyday.png" class="color-img" alt="" />
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="assets/img/clients/spinworkx_grey.png" alt="" /> 
                    <img src="assets/img/clients/spinworkx.png" class="color-img" alt="" />
                </a>
            </li>
        </ul>
    </div><!--/flexslider-->
    <!-- //End Our Clients -->
</div><!--/container-->	

@stop
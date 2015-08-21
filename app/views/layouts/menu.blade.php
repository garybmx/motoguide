   <div class="navbar">                                
                    <div class="navbar-inner">                                  
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a><!-- /nav-collapse -->                                  
                        <div class="nav-collapse collapse">                                     
                            <ul class="nav">
                                <li class="active">
                                    <a href="{{ URL::to(Config::get('app.locale') ) }}"> {{ trans('menu.main') }}         
                                    </a>                                    
                                </li>
                                <li>
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.tours') }}
                                        <b class="caret"></b>                            
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ URL::to(Config::get('app.locale')  . '/futureTours' ) }}">{{ trans('menu.futureTours') }}</a></li>
                                        <li><a href="{{ URL::to(Config::get('app.locale')  . '/pastTours' ) }}">{{ trans('menu.pastTours') }}</a></li>                                        
                                    </ul>
                                    <b class="caret-out"></b>                        
                                </li>
                                <li>
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.about') }}
                                        <b class="caret"></b>                            
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ URL::to(Config::get('app.locale')   . '/motorcycles' ) }}">{{ trans('menu.motorcycles') }}</a></li>
                                        <li><a href="{{ URL::to(Config::get('app.locale')  . '/instructors' )  }}">{{ trans('menu.instructors') }}</a></li>                                        
                                    </ul>
                                    <b class="caret-out"></b>                        
                                </li>
                                 <li>
                                    <a href="{{ URL::to(Config::get('app.locale')  . '/application' ) }}" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.application') }}
                                    </a>

                                </li>
                                <li>
                                    <a href="{{ URL::to(Config::get('app.locale')  . '/contacts' ) }}" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.contacts') }}
                                    </a>

                                </li>


                            </ul>

                        </div><!-- /nav-collapse -->                                
                    </div><!-- /navbar-inner -->
                </div><!-- /navbar -->   
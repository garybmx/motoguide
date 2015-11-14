   <div class="navbar">                                
                    <div class="navbar-inner">                                  
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a><!-- /nav-collapse -->                                  
                        <div class="nav-collapse collapse">                                     
                            <ul class="nav">
                                <li {{ HTML::active(array('IndexController@index')); }}>
                                    <a href="{{ URL::to(Config::get('app.locale') ) }}"> {{ trans('menu.main') }}         
                                    </a>                                    
                                </li>
                                <li {{ HTML::active(array('futureTours', 'pastTours'));}}>
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.tours') }}
                                        <b class="caret"></b>                            
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li {{ HTML::active(array('futureTours'));}}><a href="{{ URL::to(Config::get('app.locale')  . '/futureTours' ) }}">{{ trans('menu.futureTours') }}</a></li>
                                        <li {{ HTML::active(array('pastTours'));}}><a href="{{ URL::to(Config::get('app.locale')  . '/pastTours' ) }}">{{ trans('menu.pastTours') }}</a></li>                                        
                                    </ul>
                                    <b class="caret-out"></b>                        
                                </li>
                                <li {{ HTML::active(array('motorcycles', 'instructors')); }}>
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.about') }}
                                        <b class="caret"></b>                            
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li {{ HTML::active(array('motorcycles')); }}><a href="{{ URL::to(Config::get('app.locale')   . '/motorcycles' ) }}">{{ trans('menu.motorcycles') }}</a></li>
                                        <li {{ HTML::active(array('instructors')); }}><a href="{{ URL::to(Config::get('app.locale')  . '/instructors' )  }}">{{ trans('menu.instructors') }}</a></li>                                        
                                    </ul>
                                    <b class="caret-out"></b>                        
                                </li>
                                 <li {{ HTML::active(array('blog')); }}>
                                    <a href="{{ URL::to(Config::get('app.locale')  . '/blog' ) }}">{{ trans('menu.blog') }}
                                    </a>

                                </li>
                                 <li {{ HTML::active(array('request')); }}>
                                    <a href="{{ URL::to(Config::get('app.locale')  . '/request' ) }}" >{{ trans('menu.request') }}
                                    </a>

                                </li>
                                
                                <li {{ HTML::active(array('contacts')); }}>
                                    <a href="{{ URL::to(Config::get('app.locale')  . '/contacts' ) }}" >{{ trans('menu.contacts') }}
                                    </a>

                                </li>


                            </ul>

                        </div><!-- /nav-collapse -->                                
                    </div><!-- /navbar-inner -->
                </div><!-- /navbar -->   
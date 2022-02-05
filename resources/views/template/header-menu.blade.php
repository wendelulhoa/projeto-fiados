<!--app-header-->
<div class="app-header header d-flex navbar-collapse">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ Route('index') }}">
                <img src="{{ mix('images/logo.png') }}" class="header-brand-img main-logo" alt="IndoUi logo">Mercado Ulhôa
            </a><!-- logo-->
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle"  href="#"><i class="fe fe-align-left"></i></a>
                <a class="close-toggle"  href="#"><i class="fe fe-x"></i></a>
            </div>
            <div class="d-flex order-lg-2 ml-auto header-right">
                {{-- <div class="d-md-flex header-search" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" action="{{ Route('index') }}" method="GET" id="form-search-mod" role="search">
                        <div class="input-group ">
                            <input type="text" id="param" name="param" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fe fe-x"></i>
                                </button>
                                <button type="submit" id="search-mod" class="btn btn-default">
                                    <i class="fe fe-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div><!-- Search --> --}}
                @guest
                    
                @else
                    <div class="dropdown d-md-flex header-message">
                        <a class="nav-link icon" id="total-notifications" data-toggle="dropdown">
                            
                        </a>
                        <input type="text"  id="ids-notifications" value="" hidden>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item text-center" href="{{ Route('notification-index') }}">Notificações</a>
                            <div class="dropdown-divider"></div>
                            <div id="notifications-user"></div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center dropdown-btn pb-3">
                                <div class="btn-list">
                                    <a href="{{ Route('notification-index') }}" class=" btn btn-success btn-sm"><i class="fe fe-eye mr-1"></i>Visualizar todas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Navbar -->
                    <div class="dropdown header-profile">
                        <a class="nav-link pr-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#">
                            <span class="avatar avatar-md brround cover-image" data-image-src="{{ auth()->user()->image != null ? Route('index').'/'.'images/'.auth()->user()->image : mix('images/user.png') }}"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <div class="drop-heading">
                                <div class="text-center">
                                    <h5 class="text-dark mb-1">{{ Auth::user()->name }}</h5>
                                    <small class="text-muted"></small>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-user"></i>Perfil</a>
                            <a class="dropdown-item" href="{{ Route('notification-index') }}"><i class="dropdown-icon fe fe-mail"></i> Notificações</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="dropdown-icon fe fe-power"></i> Sair</a>
                        </div>
                    </div>
                    {{-- <div class="dropdown d-md-flex Sidebar-setting">
                        <a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div> --}}
                @endguest
            </div>
        </div>
    </div>
</div>
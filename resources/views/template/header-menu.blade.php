<!--app-header-->
<div class="app-header header d-flex navbar-collapse">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ Route('index') }}">
                <img src="{{ mix('images/logo.png') }}" class="header-brand-img main-logo" alt="IndoUi logo"> brmods
            </a><!-- logo-->
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle"  href="#"><i class="fa fa-align-left"></i></a>
                <a class="close-toggle"  href="#"><i class="fas fa-times"></i></a>
            </div>
            <div class="d-flex order-lg-2 ml-auto header-right">
                <div class="d-md-flex header-search" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group ">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div><!-- Search -->
                <div class="dropdown d-md-flex header-message">
                    <a class="nav-link icon" id="total-notifications" data-toggle="dropdown">
                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item text-center" href="#">Notificações</a>
                        <div class="dropdown-divider"></div>
                        <div id="notifications-user"></div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center dropdown-btn pb-3">
                            <div class="btn-list">
                                <a href="#" class=" btn btn-success btn-sm"><i class="fe fe-eye mr-1"></i>Visualizar todas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Navbar -->
                <div class="dropdown header-profile">
                    <a class="nav-link pr-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#">
                        <span class="avatar avatar-md brround cover-image" data-image-src="{{ mix('images/user.png') }}"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-1">Vanessa Dyer</h5>
                                <small class="text-muted">Web Developer</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-user"></i>Profile</a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-edit"></i>Schedule</a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-unlock"></i> Look Screen</a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon fe fe-power"></i> Log Out</a>
                        <div class="dropdown-divider"></div>
                        <div class="text-center dropdown-btn pb-3">
                            <div class="btn-list">
                                <a href="#" class="btn btn-icon btn-facebook btn-sm"><i class="icon icon-social-facebook"></i></a>
                                <a href="#" class="btn btn-icon btn-twitter btn-sm"><i class="icon icon-social-twitter"></i></a>
                                <a href="#" class="btn btn-icon btn-instagram btn-sm"><i class="icon icon-social-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown d-md-flex Sidebar-setting">
                    <a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
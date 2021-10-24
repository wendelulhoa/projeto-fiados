<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar">
    <ul class="side-menu toggle-menu">
        <li><h3>Principal</h3></li>
        <li>
            <a class="side-menu__item" href="{{ Route('index') }}"><i class="side-menu__icon fas fa-home"></i><span class="side-menu__label">Inicio</span></a>
        </li>
        @guest
            <li>
                <a class="side-menu__item" href="{{ Route('login') }}"><i class="side-menu__icon fas fa-lock-open"></i><span class="side-menu__label">Entrar</span></a>
            </li>
            @else
            <li class="slide">
                @if (Auth::user()->type_user == 1)
                    <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fas fa-user-cog"></i><span class="side-menu__label">Admin</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                            <li><a class="slide-item"  href="{{ Route('admin-index') }}"><span>Inicio</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-listusers') }}"><span>Úsuarios cadastrados</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-create-client-view') }}"><span>Cadastrar cliente</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-create-purchases') }}"><span>Cadastrar compra</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-new-payment') }}"><span>Pagar</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-open-payments') }}"><span>Pagamentos em aberto</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-closed-payments') }}"><span>Pagamentos</span></a></li>
                            <li><a class="slide-item"  href="{{ Route('admin-listusers') }}"><span>Úsuarios cadastrados</span></a></li>
                    
                        <li><a class="slide-item"  href="{{ Route('notification-index') }}"><span>Notificações</span></a></li>
                        <li><a class="slide-item"  href="{{ Route('user-edit') }}"><span>Atualizar informações</span></a></li>
                    </ul>
                @else
                @endif
            </li>
        @endguest
        
        
        {{-- <li><h3>Categorias</h3></li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'saude']) }}"><i class="side-menu__icon fas fa-heartbeat"></i><span class="side-menu__label">Saúde</span></a>
        </li> --}}
    </ul>
</aside>
<!--sidemenu end-->
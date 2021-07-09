<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar">
    <ul class="side-menu toggle-menu">
        <li><h3>Principal</h3></li>
        <li>
            <a class="side-menu__item" href="{{ Route('index') }}"><i class="side-menu__icon fas fa-home"></i><span class="side-menu__label">Inicio</span></a>
        </li>
        @guest
             <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fas fa-user-shield"></i><span class="side-menu__label">Entrar</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li >
                        <a class="slide-item" href="{{ route('login') }}"><i class="side-menu__icon fas fa-lock-open"></i></i>{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a class="slide-item" href="{{ route('register') }}"><i class="side-menu__icon fas fa-id-card"></i>{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
            @else
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fas fa-user-cog"></i><span class="side-menu__label">Admin</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    @if (Auth::user()->type_user == 1)
                        {{-- <li><a class="slide-item"  href="{{ Route('admin-index') }}"><span>Inicio</span></a></li> --}}
                        <li><a class="slide-item"  href="{{ Route('admin-listusers') }}"><span>Úsuarios cadastrados</span></a></li>
                        <li><a class="slide-item"  href="{{ Route('mod-approved') }}"><span>Posts aprovados</span></a></li>
                        <li><a class="slide-item"  href="{{ Route('mod-not-approved') }}"><span>Posts não aprovados</span></a></li>
                        {{-- <li><a class="slide-item"  href="{{ Route('water-mark') }}"><span>Inserir marca D'água</span></a></li> --}}
                    @else
                        {{-- <li><a class="slide-item"  href="{{ Route('user-index') }}"><span>Inicio</span></a></li> --}}
                    @endif
                    <li><a class="slide-item"  href="{{ Route('post-create-struture') }}"><span>Cadastro de post</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('my-posts') }}"><span>Meus posts</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('notification-index') }}"><span>Notificações</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('user-edit') }}"><span>Atualizar informações</span></a></li>
                </ul>
            </li>
        @endguest
        
        
        <li><h3>Categorias</h3></li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'saude']) }}"><i class="side-menu__icon fas fa-heartbeat"></i><span class="side-menu__label">Saúde</span></a>
        </li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'tecnologia']) }}"><i class="side-menu__icon fas fa-laptop-code"></i><span class="side-menu__label">Tecnologia</span></a>
        </li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'relacionamento']) }}"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Relacionamento</span></a>
        </li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'direitos-e-leis']) }}"><i class="side-menu__icon fas fa-balance-scale"></i><span class="side-menu__label">Direito e leis</span></a>
        </li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'noticias']) }}"><i class="side-menu__icon fas fa-newspaper"></i><span class="side-menu__label">Notícias</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-film"></i> <span class="side-menu__label">Entretenimento</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ Route('index-type', ['title'=>'filmes']) }}" class="slide-item ">Filmes</a></li>
                <li><a href="{{ Route('index-type', ['title'=>'desenhos']) }}" class="slide-item ">Desenhos</a></li>
                <li><a href="{{ Route('index-type', ['title'=>'animes']) }}" class="slide-item ">Animes</a></li>
                <li><a href="{{ Route('index-type', ['title'=>'series']) }}" class="slide-item ">Séries</a></li>
            </ul>
        </li>
        <li>
            <a class="side-menu__item" href="{{ Route('index-type', ['title'=>'outros']) }}"><i class="side-menu__icon fas fa-life-ring"></i><span class="side-menu__label">Outros</span></a>
        </li>
    </ul>
</aside>
<!--sidemenu end-->
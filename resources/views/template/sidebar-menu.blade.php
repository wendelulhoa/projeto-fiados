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
                        <li >
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
                        <li><a class="slide-item"  href="{{ Route('mod-approved') }}"><span>Mods aprovados</span></a></li>
                        <li><a class="slide-item"  href="{{ Route('mod-not-approved') }}"><span>Mods não aprovados</span></a></li>
                        {{-- <li><a class="slide-item"  href="{{ Route('water-mark') }}"><span>Inserir marca D'água</span></a></li> --}}
                    @else
                        {{-- <li><a class="slide-item"  href="{{ Route('user-index') }}"><span>Inicio</span></a></li> --}}
                    @endif
                    <li><a class="slide-item"  href="{{ Route('mod-create-struture') }}"><span>Cadastro de mod</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('mod-my-mods') }}"><span>Meus mods</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('notification-index') }}"><span>Notificações</span></a></li>
                    <li><a class="slide-item"  href="{{ Route('user-edit') }}"><span>Atualizar informações</span></a></li>
                </ul>
            </li>
        @endguest
        
        
        <li><h3>Categorias</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><img src="{{ mix('/images/gta5.png') }}" alt="GTAV" class="rounded-circle user_img mr-1" style="width: 30px; height: 30px;" ></i> <span class="side-menu__label">GTA V</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'tools']) }}" class="slide-item "><i class="side-menu__icon fas fa-tools"></i> Ferramentas</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'vehicles']) }}" class="slide-item " ><i class="side-menu__icon fas fa-car"></i> Veículos</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'weapons']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bomb"></i> Armas</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'scripts']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-terminal"></i> Scripts</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'player']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-tshirt"></i> Personagens</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'maps']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-map-marked-alt"></i> Mapas</a></li>
                <li><a href="{{ Route('search-category-gtav-and-tag', ['category'=> 'others']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bars"></i> Outros</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><img src="{{ mix('/images/gtasa.png') }}" alt="GTA SA" class="rounded-circle user_img mr-1" style="width: 30px; height: 30px;" ></i> <span class="side-menu__label">GTA SA</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'tools']) }}" class="slide-item "><i class="side-menu__icon fas fa-tools"></i> Ferramentas</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'vehicles']) }}" class="slide-item " ><i class="side-menu__icon fas fa-car"></i> Veículos</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'weapons']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bomb"></i> Armas</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'scripts']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-terminal"></i> Scripts</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'player']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-tshirt"></i> Personagens</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'maps']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-map-marked-alt"></i> Mapas</a></li>
                <li><a href="{{ Route('search-category-gtasa-and-tag', ['category'=> 'others']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bars"></i> Outros</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><img src="{{ mix('/images/ets2.png') }}" alt="EURO TRUCK SIMULATOR 2" class="rounded-circle user_img mr-1" style="width: 30px; height: 30px;" ></i> <span class="side-menu__label">Euro Truck Simulator 2</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ Route('search-category-ets2-and-tag', ['category'=> 'tools']) }}"  class="slide-item" ><i class="side-menu__icon fas fa-tools"></i> Ferramentas</a></li>
                <li><a href="{{ Route('search-category-ets2-and-tag', ['category'=> 'trucks']) }}"  class="slide-item" ><i class="side-menu__icon fas fa-truck-moving"></i> Caminhões</a></li>
                <li><a href="{{ Route('search-category-ets2-and-tag', ['category'=> 'buses']) }}"  class="slide-item" ><i class="side-menu__icon fas fa-bus-alt"></i> Ônibus</a></li>
                <li><a href="{{ Route('search-category-ets2-and-tag', ['category'=> 'maps']) }}"  class="slide-item" ><i class="side-menu__icon fas fa-map-marked-alt"></i> Mapas</a></li>
                <li><a href="{{ Route('search-category-ets2-and-tag', ['category'=> 'others']) }}"  class="slide-item" ><i class="side-menu__icon fas fa-bars"></i> Outros</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><img src="{{ mix('/images/gta4.ico') }}" alt="GTAIV" class="rounded-circle user_img mr-1" style="width: 30px; height: 30px;" ></i> <span class="side-menu__label">GTA IV</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'tools']) }}" class="slide-item "><i class="side-menu__icon fas fa-tools"></i> Ferramentas</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'vehicles']) }}" class="slide-item " ><i class="side-menu__icon fas fa-car"></i> Veículos</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'weapons']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bomb"></i> Armas</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'scripts']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-terminal"></i> Scripts</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'player']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-tshirt"></i> Personagens</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'maps']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-map-marked-alt"></i> Mapas</a></li>
                <li><a href="{{ Route('search-category-gtaiv-and-tag', ['category'=> 'others']) }}" class="slide-item "  ><i class="side-menu__icon fas fa-bars"></i> Outros</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><img src="{{ mix('/images/model-3d.png') }}" alt="Modelos 3d" class="rounded-circle user_img mr-1" style="width: 30px; height: 30px;" ></i> <span class="side-menu__label">Modelos 3D</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a href="#" class="slide-item category-mod" data-category-game="5" data-category-mod="1"><i class="side-menu__icon fas fa-car"></i> Veículos</a></li>
                <li><a href="#" class="slide-item category-mod" data-category-game="5" data-category-mod="1"><i class="side-menu__icon fas fa-bomb"></i> Contruções</a></li>
                <li><a href="#" class="slide-item category-mod" data-category-game="5" data-category-mod="1"><i class="side-menu__icon fas fa-terminal"></i> Texturas</a></li>
                <li><a href="#" class="slide-item category-mod" data-category-game="5" data-category-mod="1"><i class="side-menu__icon fas fa-tshirt"></i> Personagens</a></li>
                <li><a href="#" class="slide-item category-mod" data-category-game="5" data-category-mod="1"><i class="side-menu__icon fas fa-bars"></i> Outros</a></li>
            </ul>
        </li>
    </ul>
</aside>
<!--sidemenu end-->
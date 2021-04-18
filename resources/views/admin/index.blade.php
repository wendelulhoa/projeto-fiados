@extends('admin.menu')

@section('content')
@extends('admin.card-struture')
@section('content-cards')
@include('admin.cards', ['name'=>'Vendas', 'total'=>200, 'icon'=> '<i
    class="fas fa-money-bill-alt fa-3x text-success"></i>'])
@include('admin.cards', ['name'=>'Mods', 'total'=>200, 'icon'=> '<i class="fas fa-3x fa-car"></i>'])
@include('admin.cards', ['name'=>'Usuarios', 'total'=> 1000, 'icon'=>'<i class="fas fa-users fa-3x text-info"></i>'])
@include('admin.cards', ['name'=>'Categorias', 'total'=> 20, 'icon'=>'<i class="fas fa-barcode fa-3x"></i>'])
@endsection

<div class="container-fluid ">
    <div class="row ">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Tag</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Mods</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Categorias/mods</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            @include('tags.index',compact('tags'))
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @include('mods.index',compact('mods'))
                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
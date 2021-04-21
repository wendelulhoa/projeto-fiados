@extends('admin.menu')

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-xl-9 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                    <h2>Casdastros</h2>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Tag</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Categoria mod</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Usuario</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            @include('admin.card-create', ['name'=>'Tag', 'placeholder'=>'Digite uma tag', 'id'=>'tag', 'route'=> Route('tags-create')])
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @include('admin.card-create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create')])
                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="col-xs-12 col-lg-6">
                            @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create'), 'tags'=>$tags, 'category'=> $category])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts-css')
    @include('admin.card-mod-css')
@endpush
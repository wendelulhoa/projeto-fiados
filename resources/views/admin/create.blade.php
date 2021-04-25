@extends('layouts.menu')

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-xl-9 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                    <h2>Casdastros</h2>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-category-tab" data-toggle="tab" href="#nav-category"
                                role="tab" aria-controls="nav-home" aria-selected="true">Tag</a>
                            <a class="nav-item nav-link" id="nav-tag-tab" data-toggle="tab" href="#nav-tag"
                                role="tab" aria-controls="nav-tag" aria-selected="false">Categoria</a>
                            <a class="nav-item nav-link" id="nav-mod-tab" data-toggle="tab" href="#nav-mod"
                                role="tab" aria-controls="nav-mod" aria-selected="false">Mod</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-category" role="tabpanel"
                            aria-labelledby="nav-category-tab">
                            @include('admin.card-create', ['name'=>'Tag', 'placeholder'=>'Digite uma tag', 'id'=>'tag', 'route'=> isset($route) ? $route : Route('tags-create'), 'content'=>$tags ?? []])
                        </div>

                        <div class="tab-pane fade" id="nav-tag" role="tabpanel" aria-labelledby="nav-tag-tab">
                            @include('admin.card-create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create'), 'content'=>[]])
                        </div>

                        <div class="tab-pane fade" id="nav-mod" role="tabpanel" aria-labelledby="nav-mod-tab">
                            <div class="col-xs-12 col-lg-12">
                            @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create')])
                            @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create')])
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
@extends('template.index')

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
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Cadastros</h3>
                </div>

            </div>
            <div class="card-body">
                <form id="form-create">
                    <div class="list-group">
                        <div class="list-group-item py-3" data-acc-step>
                            <h5 class="mb-0" data-acc-title>Categoria Jogo</h5>
                            <div data-acc-content>
                                <div class="my-3">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" name="email" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item py-3" data-acc-step>
                            <h5 class="mb-0" data-acc-title>Tag</h5>
                            <div data-acc-content>
                                <div class="my-3">
                                    <div class="form-group">
                                        <label>Telephone:</label>
                                        <input type="text" name="telephone" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile:</label>
                                        <input type="text" name="mobile" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item py-3" data-acc-step>
                            <h5 class="mb-0 form-collapse" data-form="categoria" data-acc-title>Categoria</h5>
                            <div class="categoria">
                                <div class="my-3">
                                    <div class="form-group">
                                        <label>Telephone:</label>
                                        <input type="text" name="telephone" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile:</label>
                                        <input type="text" name="mobile" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item py-3" data-acc-step>
                            <h5 class="mb-0" data-acc-title>Mod</h5>
                            <div data-acc-content>
                                <div class="my-3">
                                    <div class="form-group">
                                        <label>Credit card:</label>
                                        <input type="text" name="card" class="form-control">
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-sm-4">
                                            <label>Expiry:</label>
                                            <input type="text" name="expiry" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>CVV:</label>
                                            <input type="text" name="cvv" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts-css')
@include('admin.card-mod-css')
@endpush
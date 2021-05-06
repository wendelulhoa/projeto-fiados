@extends('template.index')

@section('content')

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
                    <div class="list-group">
                        <div class="list-group-item py-3" data-acc-step>
                           <a href="!#" class="mb-0 form-collapse-tab" data-content="1">  <h5 class="mb-0" data-content="1" data-acc-title>Categoria Jogo</h5> </a>
                            <div class="1" data-acc-content>
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
                           <a href="#" class="mb-0 form-collapse-tab" data-content="2"> <h5 class="mb-0" data-acc-title>Tag</h5></a> 
                            <div class="2" data-acc-content>
                                <div class="my-3">
                                    @include('admin.card-create', ['name'=>'Tag', 'placeholder'=>'Digite uma tag', 'id'=>'tag', 'route'=> isset($route) ? $route : Route('tags-create'), 'content'=>$tags ?? []])
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item py-3" data-acc-step>
                            <a href="#" class="mb-0 form-collapse-tab" data-content="3"><h5 class="mb-0" data-acc-title>Categoria</h5></a>
                            <div class="3" data-acc-content>
                                @include('admin.card-create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create'), 'content'=>[]])
                            </div>
                        </div>
                        <div class="list-group-item py-3" data-acc-step>
                            <a href="#" class="mb-0 form-collapse-tab" data-content="4"><h5 class="mb-0" data-acc-title>Mod</h5></a>
                            <div class="4" data-acc-content>
                                <div class="my-3">
                                    @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria', 'id'=>'category', 'route'=> Route('category-create')])
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-js')
   @include('admin.admin-js') 
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@extends('template.index')

@section('content')

<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Cadastro Mod</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item py-3" data-acc-step>
                        <a href="#" class="mb-0 form-collapse-tab" data-content="4">
                            <h5 class="mb-0" data-acc-title>Mod</h5>
                        </a>
                        <div class="4" data-acc-content>
                            <div class="my-3">
                                @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria',
                                'id'=>'category', 'route'=> Route('category-create')])
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
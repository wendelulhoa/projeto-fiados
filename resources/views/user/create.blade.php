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
            <div class="pt-4">
                @include('mods.create', ['name'=>'categoria', 'placeholder'=>'Digite uma categoria',
                                    'id'=>'category', 'route'=> Route('category-create')])
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-css')
    <style>
        #global-loader{
            background: rgba(10,23,55,0.5);
            padding-top: 200px;
            
        }
    </style>
@endsection
@section('script-js')
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
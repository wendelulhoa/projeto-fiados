@extends('template.index')

@section('content')

<div class="row">
    @include('layouts.cards', ['name'=>'Vendas', 'total'=>200, 'icon'=> '<i class="fas fa-money-bill-alt text-success"></i>'])
    @include('layouts.cards', ['name'=>'Mods', 'total'=>200, 'icon'=> '<i class="fas fa-car"></i>'])
    @include('layouts.cards', ['name'=>'Usuarios', 'total'=> 1000, 'icon'=>'<i class="fas fa-users text-info"></i>'])
    @include('layouts.cards', ['name'=>'Categorias', 'total'=> 20, 'icon'=>'<i class="fas fa-barcode"></i>'])
</div>

@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
@endsection
@endsection
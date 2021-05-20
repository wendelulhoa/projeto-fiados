@extends('template.index')

@section('content')

{{-- CARDS SUPERIORES --}}
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-10  ml-auto">
                <div class="row pt-md-2 mt-md-3 mb-5">
                    @include('layouts.cards', ['name'=>'Vendas', 'total'=>200, 'icon'=> '<i class="fas fa-money-bill-alt fa-3x text-success"></i>'])
                    @include('layouts.cards', ['name'=>'Mods', 'total'=>200, 'icon'=> '<i class="fas fa-3x fa-car"></i>'])
                    @include('layouts.cards', ['name'=>'Usuarios', 'total'=> 1000, 'icon'=>'<i class="fas fa-users fa-3x text-info"></i>'])
                    @include('layouts.cards', ['name'=>'Categorias', 'total'=> 20, 'icon'=>'<i class="fas fa-barcode fa-3x"></i>'])
                </div>
            </div>
        </div>
    </div>
</section>

@include('mods.table',compact('mods'))
@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
@endsection
@endsection
@extends('template.index')

@section('content')
<div class="row">
    @include('layouts.card-values', ['title' => 'clientes', 'value'   => $totalClients])
    @include('layouts.card-values', ['title' => 'em aberto', 'value'  =>'1000'])
    @include('layouts.card-values', ['title' => 'pagamentos', 'value' =>'1000'])
    @include('layouts.card-values', ['title' => 'quantidade de vendas', 'value'=>'1000'])
</div>

<div class="row">  
    @include('admin.components.chart-purchases-and-payments')
    @include('admin.components.table-small', ['content' => $closedPayments, 'title' => 'pagamentos'])
    @include('admin.components.table-small', ['content' => $openPayments, 'title' => 'Em aberto'])
    @include('admin.components.table-small', ['content' => $purchases, 'title' => 'Últimas compras'])
</div>

@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
@endsection
@endsection
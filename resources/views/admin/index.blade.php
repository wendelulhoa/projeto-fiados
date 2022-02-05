@extends('template.index')

@section('content')
<div class="row">
    @include('layouts.card-values', ['title' => 'clientes', 'value'   => $totalClients])
    @include('layouts.card-values', ['title' => 'pagamentos', 'value' =>"R$: ". moneyconvert($totalPayment)])
    @include('layouts.card-values', ['title' => 'Compras', 'value'  =>"R$: " . moneyconvert($totalPurchase)])
    @include('layouts.card-values', ['title' => 'quantidade de vendas', 'value'=>$salesQuantity])
</div>

<div class="row">  
    @include('admin.components.chart-purchases-and-payments')
    @include('layouts.table-small', ['content' => $closedPayments, 'title' => 'pagamentos', 'link' => Route('admin-closed-payments', [Session::get('month'), Session::get('year')])])
    @include('layouts.table-small', ['content' => $openPayments, 'title' => 'Em aberto', 'link' => Route('admin-open-payments', [Session::get('month'), Session::get('year')])])
    @include('layouts.table-small', ['content' => $purchases, 'title' => 'Últimas compras', 'link' => ''])
</div>

@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
    @include('layouts.chart-js')
@endsection
@endsection
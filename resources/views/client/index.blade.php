@extends('template.index')

@section('content')

    @include('layouts.modal-purchases')


    <div class="row">
        @include('layouts.card-values', ['title' => 'limite', 'value'   => $limit])
        @include('layouts.card-values', ['title' => 'pagamentos', 'value' =>"R$: ". moneyconvert($totalPayment)])
        @include('layouts.card-values', ['title' => 'Compras', 'value'  =>"R$: " . moneyconvert($totalPurchase)])
    </div>

    <div class="row">
        @include('admin.components.chart-purchases-and-payments')
        @include('layouts.table-small', ['content' => $closedPayments, 'title' => 'pagamentos'])
        @include('layouts.table-small', ['content' => $openPayments, 'title' => 'Em aberto'])
        @include('layouts.table-small', ['content' => $purchases, 'title' => 'Últimas compras'])
    </div>

    @section('script-js')
        @include('client.client-js')
        @include('layouts.chart-js')
        <script>
            /* Link para navegar entre periodos. */ 
            var linkUpdate = "{{ Route('client-index', [0, 0]) }}";
        </script>
    @endsection
@endsection
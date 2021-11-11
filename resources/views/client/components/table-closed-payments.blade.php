<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h3 class="card-title">Pagos</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data pagamento</th>
                            <th>Total pago</th>
                            <th>Ver compras</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($closedPayments as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                            <td>R$: {{moneyConvert($item->amount)}}</td>
                            <td><button class="btn btn-success btn-sm " onclick="searchPurchases({{$item->id}})" >ver compras</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
        <div class="pt-2" >
            {{ $closedPayments->links() }}
        </div>
</div><!-- col end -->
</div>
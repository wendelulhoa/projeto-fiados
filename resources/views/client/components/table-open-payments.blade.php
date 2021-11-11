<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h3 class="card-title">Pagamentos em aberto</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th colspan="2">Nome</th>
                            <th>dia de abertura</th>
                            <th colspan="2">Ver compras</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($openPayments as $item)
                        <tr>
                            <td colspan="2">{{ $item->name }}</td>
                            <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                            <td colspan="2"><button class="btn btn-success btn-sm " onclick="searchPurchases({{$item->id}})" >ver compras</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
        <div class="pt-2" >
            {{ $openPayments->links() }}
        </div>
    </div><!-- col end -->
</div>
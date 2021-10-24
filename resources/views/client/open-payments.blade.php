@extends('template.index')
 
 
@section('content')
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
                            <th>Nome</th>
                            <th>Tipo Úsuario</th>
                            <th>Ver compras</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($openPayments as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->type_user != 0? 'Admin' : 'Normal' }}</td>
                            <td>{!! '<button class="btn btn-success btn-sm " >ver compras</button>' !!}</td>
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
@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@endsection

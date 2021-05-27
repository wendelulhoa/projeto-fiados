 @extends('template.index')
 
 
@section('content')
    @php
        // dd($users);
    @endphp
    <div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h3 class="card-title">{{ Route::getCurrentRoute()->getName() != 'mod-approved' ? 'Mods não aprovados' : 'Mods aprovados' }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo Úsuario</th>
                            <th>Status</th>
                            <th>data criação</th>
                            <th colspan="3">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr id="tr-{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->type_user != 0? 'Admin' : 'Normal' }}</td>
                                <td>{!! $item->active ? '<button class="btn btn-success btn-sm " >ativo</button>' : '<button class="btn btn-danger btn-sm " >bloqueado</button>' !!}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td>{!! !$item->active ? '<button class="btn btn-success btn-sm " >ativar</button>' : '<button class="btn btn-danger btn-sm " >bloquear</button>' !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
        <div class="pt-2" >
            {{ $users->links() }}
        </div>
    </div><!-- col end -->
</div>
@endsection

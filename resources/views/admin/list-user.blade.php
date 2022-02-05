 @extends('template.index')
 
 
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h3 class="card-title">Usuarios</h3>
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
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            @php
                                $routeDisable = Route("admin-user-disable", ["id"=>$item->id]);
                                $routeActive  = Route("admin-user-active", ["id"=>$item->id]);
                                $buttonActive = "<button class='btn btn-success btn-sm user' data-type='".$item->active."' data-route='".$routeActive."'>Ativar</button>";
                                $buttonDisable= "<button class='btn btn-danger btn-sm user' data-type='".$item->active."' data-route='".$routeDisable."'>Bloquear</button>";
                            @endphp
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->type_user != 0? 'Admin' : 'Normal' }}</td>
                            <td>{!! $item->active ? '<button class="btn btn-success btn-sm " >ativo</button>' : '<button class="btn btn-danger btn-sm " >bloqueado</button>' !!}</td>
                            <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                            <td>{!! $item->active ? $buttonDisable : $buttonActive  !!}</td>
                            <td><a href="{{$item->type_user != 0 ? '#' : route('admin-edit-client-view', ['id' => $item->id])}}"><i class="fas fa-edit"></i></i></a></td>
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
@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('.user').click(function(){
            var action = ()=>{
                $.ajax({
                    url: $(this).attr('data-route'),
                    method:'POST',
                    data: {
                        id   : $(this).attr('data-id'),
                        type : $(this).attr('data-type') == 'true' ? true : false,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data){
                        toastr.success("Sucesso!")
                        setTimeout(function(){
                            window.location.reload(true)
                        },500);
                    },
                    error: function(){
                        toastr.error("ocorreu um erro.")
                    }
                });
            }
            sweetAlert(`Tem certeza que deseja ${$(this).attr('data-type') != true ? 'Ativar' : 'Bloquear' }?`, action)
        });
    </script>
@endsection
@endsection

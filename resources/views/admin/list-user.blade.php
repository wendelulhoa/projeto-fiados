 @extends('template.index')
 
 
@section('content')
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                        <h3 class="text-muted text-center mb-3">Usuarios</h3>
                        <table class="table col-12 m-auto table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">data criação</th>
                                    <th scope="col">tipo usuario</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                    <td>{{ $item->type_user == 1 ? 'Administrador' : 'Normal' }}</td>
                                    <td><a href=""><i class="fas fa-edit"></i></i></a></td>
                                    <td><a href="" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

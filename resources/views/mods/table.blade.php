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
                            <th>Nome mod</th>
                            <th>data criação</th>
                            <th>Link</th>
                            <th colspan="3">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mods as $item)
                            <tr id="tr-{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td><a href="{{ Route('mods-detail',['id'=>$item->id]) }}"><i class="fas fa-external-link-alt"></i></a></td>
                                @if (Auth::user()->type_user != 0)
                                    <td>{!! $item->approved != true && Auth::user()->type_user != 0 ? '<button class="btn btn-success btn-sm status-mod" data-id="'.$item->id.'" data-type="false">Aprovar</button>' : '<button class="btn btn-danger btn-sm status-mod" id="status-mod" data-id="'.$item->id.'" data-type="true">Bloquear</button>' !!} </td>
                                @else
                                    <td>{{ Auth::user()->type_user == 0 && $item->approved ? 'Aprovado' : 'Não aprovado' }}</td>
                                @endif
                                <td><a href="{{ Route('mods-edit', ['id'=> $item->id]) }}"><i class="fas fa-edit"></i></i></a></td>
                                <td><a href="{{ Route('mods-delete', ['id'=> $item->id]) }}" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
        <div class="pt-2" >
            {{ $mods->links() }}
        </div>
    </div><!-- col end -->
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                    <h3 class="card-title">Mods não aprovados</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Nome mod</th>
                            <th>data criação</th>
                            <th>Link</th>
                            <th colspan="3">aprovar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mods as $item)
                            <tr id="tr-{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td><a href="{{ Route('mods-detail',['id'=>$item->id]) }}"><i class="fas fa-external-link-alt"></i></a></td>
                                <td>{!! $item->approved != true ? '<button class="btn btn-success">Aprovar</button>' : '<button class="btn btn-danger">Bloquear</button>' !!}</td>
                                <td><a href=""><i class="fas fa-edit"></i></i></a></td>
                                <td><a href="" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
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
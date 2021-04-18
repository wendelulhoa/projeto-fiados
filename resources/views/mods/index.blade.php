<div class="container-fluid ">
    <div class="row ">
        <div class="col-xl-12 col-lg-9 col-md-8 ">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                    <h3 class="text-muted text-center mb-3">Mods</h3>
                    <table class="table col-12 m-auto table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nome Mod</th>
                                <th scope="col">data criação</th>
                                <th scope="col" colspan="1">aprovação</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mods as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td><input type="checkbox" style="margin-left:30px"></td>
                                <td><a href=""><i class="fas fa-edit"></i></i></a></td>
                                <td><a href="" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pt-2">
                {{ $mods->links() }}
            </div>
        </div>
    </div>
</div>
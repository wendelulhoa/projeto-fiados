<div class="container-fluid ">
    <div class="row ">
        <div class="col-xl-12 col-lg-9 col-md-8">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">
                    <h3 class="text-muted text-center mb-3">Tags</h3>
                    <table class="table col-12 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nome tag</th>
                                <th scope="col">data criação</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td><a href=""><i class="fas fa-edit"></i></i></a></td>
                                <td><a href="" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div>
                @if (Route::getCurrentRoute()->getName() == 'post-approved')
                    <h3 class="card-title">Posts aprovados</h3>
                @elseif(Route::getCurrentRoute()->getName() == 'my-posts')
                    <h3 class="card-title">Meus Posts</h3>
                @else
                    <h3 class="card-title">Posts não aprovados</h3>
                @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Nome post</th>
                            <th>data criação</th>
                            <th>Link</th>
                            <th colspan="3">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            @php
                                $titleUrl = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/"),explode(" ","a A e E i I o O u U n N c "),$item->title);
                            @endphp
                            <tr id="tr-{{ $item->id }}">
                                <td>{{ $item->title }}</td>
                                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                                <td><a href="{{ Route('post-detail',['id'=>$item->id, 'type'=> $categories[$item->category] ?? 0, 'title'=>str_replace(" ", "-", $titleUrl) ]) }}"><i class="fas fa-external-link-alt"></i></a></td>
                                @if (Auth::user()->type_user != 0)
                                    <td>{!! $item->approved != true && Auth::user()->type_user != 0 ? '<button class="btn btn-success btn-sm status-mod" data-id="'.$item->id.'" data-type="false">Aprovar</button>' : '<button class="btn btn-danger btn-sm status-mod" id="status-mod" data-id="'.$item->id.'" data-type="true">Bloquear</button>' !!} </td>
                                @else
                                    <td>{{ Auth::user()->type_user == 0 && $item->approved ? 'Aprovado' : 'Não aprovado' }}</td>
                                @endif
                                <td><a href="{{ Route('post-edit', ['id'=> $item->id]) }}"><i class="fas fa-edit"></i></i></a></td>
                                <td><a class="delete-mod" href="{{ Route('post-delete', ['id'=> $item->id]) }}" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
        <div class="pt-2" >
            {{ $posts->links() }}
        </div>
    </div><!-- col end -->
</div>
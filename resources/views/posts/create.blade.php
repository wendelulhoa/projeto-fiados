@extends('template.index')

@section('content')

<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">{{Route::current()->getName() == 'post-edit' ? 'Edição post' : 'Cadastro post' }}</h3>
                </div>
            </div>
            <div class="p-4">
                <form action="{{ Route::current()->getName() == 'post-edit' ? Route('post-update', ['id'=> $id]) : Route('post-create') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group col-md-12">
                        <label for="name" class="">Título</label>
                        <input type="text" name="title"  id="title" class="form-control reset" value="{{ $post[0]->title ?? '' }}" placeholder="Digite um título" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Imagem em destaque (opcional)</label><br />
                        <input type="file" class="reset" id="file" name="file"><br />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="category-select">Categoria</label>
                        <select id="category-select" class="form-control reset select2" name="category" required>
                            @foreach ($categories as $key => $item)
                            <option value="{{$key}}" {{$loop->first && !isset($post[0]->category) ? 'selected' : ''}} {{ isset($post[0]->category) && $post[0]->category == $key ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea id="content" name="content" style="height: 500px">
                            @php
                                $content = $post[0]['content'] ?? json_encode([]);
                                $content = json_decode($content);
                                $content = $content->content ?? null;
                            @endphp
                            {{$content == null ? '' : $content}}
                        </textarea>
                    </div>
                    <button type="submit" id="teste" class="btn btn-primary float-right ml-2 pt-2 mt-2">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #global-loader{
            background: rgba(10,23,55,0.5);
            padding-top: 200px;
            
        }
    </style>
@endsection
@section('script-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/8euaj5mb0ku2e3vk260yqswzvp6qnguryhb4jr0zuj02ki19/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'pagebreak hr image media lists directionality link code',
    });
    $('.select2').select2();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
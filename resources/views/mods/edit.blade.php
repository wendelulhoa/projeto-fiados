@extends('template.index')

@section('content')

<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Cadastro Mod</h3>
                </div>
            </div>
            <div class="pt-4">
                @include('mods.create', ['id' => $mod[0]->id ,'title'=> $mod[0]->name, 'linkMod'=> $mod[0]->link, 'images'=> $mod[0]->images, 'route'=> Route('category-create')])
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-js')
<script>
    $(document).ready(function(){
        getCategorysAndTags();
        $('#category-game-select').val('{{ $mod[0]->category_game ??  0 }}').change()
        $('#category-select').val('{{ $mod[0]->category ??  0  }}').change()
        $('#description-not-send').val("{!!  str_replace(['<p>', '</p>', '"'], ['', '\n', ''], $mod[0]->description) ?? ''  !!}")
    });

    $('.delete').click(function(){
        var action = ()=>{
            var divRemove = $(this).parent().parent().parent().parent();
            
            $.ajax({
                url: " {{ Route('mods-images-delete',['id'=> $mod[0]->id ]) }} ",
                method: 'delete',
                data:{
                    "_token": "{{ csrf_token() }}",
                    path: $(this).attr('data-path')
                },
                success: function(){
                    toastr.success("Excluído com sucesso!");
                    divRemove.remove();
                }
            });
        }
        sweetAlert('Deseja apagar essa imagem ?', action); 
    })
</script>
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
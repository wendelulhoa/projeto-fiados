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
                @include('mods.create', ['id' => $mod[0]->id ,'title'=> $mod[0]->name, 'linkMod'=> $mod[0]->link, 'linkVideo'=>$mod[0]->link_video, 'images'=> $mod[0]->images, 'route'=> Route('category-create'), 'release'=> $mod[0]->release])
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
@endsection
@section('script-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('#category-game-select').val('{{ $mod[0]->category_game ??  0 }}').change();
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
    });
</script>
@include('admin.admin-js')
@include('mods.mod-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
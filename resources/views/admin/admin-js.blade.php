
<script type="text/javascript" defer>
    
    $('.status-mod').click(function(){
        var id = $(this).attr('data-id');
        var action = ()=>{
            $.ajax({
                url: "",
                method:'POST',
                data: {
                    id   : $(this).attr('data-id'),
                    type : $(this).attr('data-type') == 'true' ? true : false,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    $(`#tr-${id}`).fadeOut();
                }
            });
        }
        sweetAlert(`Tem certeza que deseja ${$(this).attr('data-type') != 'true' ? 'aprovar' : 'bloquear' }?`, action)
    });

    $('.delete-mod').click(function(e){
        e.preventDefault();
        var element = $(this).parent().parent()
        var action = ()=>{
            $.ajax({
                url: $(this).attr('href'),
                method:'POST',
                data: {
                    id   : $(this).attr('data-id'),
                    type : $(this).attr('data-type') == 'true' ? true : false,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    toastr.success("Cadastrado com sucesso")
                    element.fadeOut();
                }
            });
        };

        sweetAlert(`Tem certeza que deseja excluir?`, action)
    });
</script>
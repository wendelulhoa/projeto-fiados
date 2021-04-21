
<script type="text/javascript" defer>
    
    $('form').on('submit',function(e){
        e.preventDefault()
        Swal.fire({
            title: 'Tem certeza que deseja salvar este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: $(this).attr('data-route'),
                    method:'POST',
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        alert('sucesso')
                        $('.reset').val('');
                    }
                });
            }
          }); 

        
    });

</script>
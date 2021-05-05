
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
               var ajax = $.ajax({
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

    $('#nav-mod-tab').click(function(){
        $.ajax({
            url:"{{  Route('admin-category-and-tag') }}",
            method:'GET',
            success: function(data){
                $('#tag-select option').remove();
                $('#category-select option').remove();
                
                for(var i= 0; i < data['category'].length ; i++){
                    console.log(data['category'][i].id, data['category'][i].name)
                    $('#category-select').append(`<option value="${data['category'][i].id}" selected>${data['category'][i].name}</option>`);
                }

                for(var i= 0; i < data['tags'].length ; i++){
                    $('#tag-select').append(`<option value="${data['tags'][i].id}" selected>${data['tags'][i].name}</option>`);
                }
            }
        });
    });

</script>
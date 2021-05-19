
<script type="text/javascript" defer>
    var filesAdd = [];
    $('#file').change(function(){
      $('#img-mods').html("");
      const total = $(this)[0].files.length;
      var imgs    = [];

      for(var i = 0; i < total ; i++){
        var files = $(this)[0].files[i];
        filesAdd.push(files)

        const fileReader = new FileReader();
        fileReader.onloadend = function(){
           $('#img-mods').append(`
                <div class="col-6 col-md-3">
                    <a class="member"> <img src="${fileReader.result}" alt="thumb1" class="thumbimg">
                        <div class="memmbername">
                        </div>
                    </a>
                </div>
            `);
        };
        
        fileReader.readAsDataURL(files)
      } 
    });

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
                        $('body').append(`<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>`);
                        $('.reset').val('');
                    }
                });
                
            }
          }); 
    });

    function getCategorysAndTags(){
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
    }

    /*tabs*/
    $('.form-collapse-tab').click(function(e){
        e.preventDefault();
        var classElement = $(this).attr('data-content');
        
        if($(`.${classElement}`).hasClass('active')){
            $(`.${classElement}`).removeClass('d-block active');  
        }else{
            if($(`.${classElement}`).hasClass('4')){
               getCategorysAndTags(); 
            }
            $(`.active`).removeClass('d-block active'); 
            $(`.${classElement}`).addClass('d-block active');
        }  
    });

</script>
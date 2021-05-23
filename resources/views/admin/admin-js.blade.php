
<script type="text/javascript" defer>
    var filesAdd = [];
    var categoryMod      = [];
    var gtaCategory      = [1, 4, 5, 6, 7, 8, 9];
    var etsCategory      = [2, 3, 7, 8, 9];
    var Model3dCategory  = [1, 6, 8, 10, 11];

    $('.img-mod').change(function(){
      $('#img-mods').html("");
      const element = $(this);
      const total = $(this)[0].files.length;
      var imgs    = [];
      var files = $(this)[0].files[0];

      for(var i = 0; i < total ; i++){
        var files = $(this)[0].files[i];
        filesAdd.push(files)
        
        const fileReader = new FileReader();
        fileReader.onloadend = function(){
           $('#img-mods').append(`
                <div class="col-6 col-md-3">
                    <a class="member"> <img src="${fileReader.result}" alt="thumb1" class="thumbimg">
                        <div class="memmbername">
                        ${element.attr('id') == 'img-principal' ? 'Principal' : '' }
                        </div>
                    </a>
                </div>
            `);
        };
        
        fileReader.readAsDataURL(files)
      } 
    });

    $('form').on('submit',function(e){
        if($(this).attr('id') == 'form-category' || $(this).attr('id') == 'perfil-img' || $(this).attr('id') == 'form-password' ){
            return;
        }
        e.preventDefault();
        
        $('#description').val(convertHtmlDescription($('#description-not-send').val()));

        Swal.fire({
            title: 'Tem certeza que deseja salvar este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
                $('#global-loader').html(`
                    <div class="row" style="width: 100%;">
                        <div class="col">
                            <div class="col-6 ml-auto mr-auto">
                                <img src="{{ mix('/images/pac-man.svg') }}" alt="loader">
                                <div class="progress d-flex">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 1%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                
                $('#global-loader').removeClass('global-hide');
                $('#global-loader').addClass('global-see');

               var ajax = $.ajax({
                    url: $(this).attr('data-route'),
                    method:'POST',
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        $('#global-loader').removeClass('global-hide');
                        $('#global-loader').addClass('global-see');
                        @if(Route::current()->getName() == 'admin-create')
                            const total = $('#files')[0].files.length;
                            const imgs  = $('#files')[0].files;
                            var key     = 0;

                            for(var i = 0; i < total ; i++){
                                var files        = imgs[i];
                                var fd = new FormData();
                                
                                fd.append('file', files);
                                fd.append("_token", "{{ csrf_token() }}");
                                fd.append("id", data.id);

                                $.ajax({
                                    url: "{{ Route('mods-store-images') }}",
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    type: 'POST',
                                    success: function(data) {
                                        key++;
                                        $('#global-loader').html(`
                                            <div class="row" style="width: 100%;">
                                                <div class="col">
                                                    <div class="col-6 ml-auto mr-auto">
                                                    <img src="{{ mix('/images/pac-man.svg') }}" alt="loader">
                                                        <div class="progress d-flex">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: ${parseInt(((100 * key) / total))}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <strong><span>${key}</span> de ${total} arquivos salvos</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        `);  

                                        if(key == total){
                                            $('#global-loader').removeClass('global-see');
                                            $('#global-loader').addClass('global-hide');
                                            alert('cadastrado com sucesso')
                                            $('.reset').val('');
                                            $('#img-mods').html("");
                                        }
                                    }
                                });
                            }
                        @else
                            alert('cadastrado com sucesso')
                            $('.reset').val('');
                            $('#img-mods').html("");
                        @endif
                   
                        
                        
                    },
                    error: function(data){
                        alert('ocorreu um erro')
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
                $('#category-game-select option').remove();
                $('#category-select option').remove();

                categoryMod =  data['category'];
                
                for(var i= 0; i < data['categoryGame'].length ; i++){
                    $('#category-game-select').append(`<option value="${data['categoryGame'][i].id}" selected>${data['categoryGame'][i].name}</option>`);
                }

                $('#category-game-select').val(1).change();

                for(var i= 0; i < gtaCategory.length ; i++){
                    let category = categoryMod.find((e, key) => {
                        if(e.id == gtaCategory[i]){
                            $('#category-select').append(`<option value="${data['category'][i].id}" selected>${data['category'][i].name}</option>`);
                        }
                    });
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
            $(`.active`).removeClass('d-block active'); 
            $(`.${classElement}`).addClass('d-block active');
        }  
    });

    @if(Route::current()->getName() == 'admin-create')
        $(document).ready(function(){
            getCategorysAndTags(); 
        });
    @endif


    $('#category-game-select').change(function(){
        $('#category-select option').remove();
        
        switch(parseInt($(this).val())){
            case 1:
            case 2:
            case 4:
                for(var i= 0; i < gtaCategory.length ; i++){
                    let category = categoryMod.find((e, key) => {
                        if(e.id == gtaCategory[i]){
                            $('#category-select').append(`<option value="${categoryMod[i].id}" selected>${categoryMod[i].name}</option>`);
                        }
                    });
                }
                break;
            case 3:
                for(var i= 0; i < etsCategory.length ; i++){
                    let category = categoryMod.find((e, key) => {
                        if(e.id == etsCategory[i]){
                            $('#category-select').append(`<option value="${categoryMod[i].id}" selected>${categoryMod[i].name}</option>`);
                        }
                    });
                }
                break;
            case 5:
                for(var i= 0; i < Model3dCategory.length ; i++){
                    let category = categoryMod.find((e, key) => {
                        if(e.id == Model3dCategory[i]){
                            $('#category-select').append(`<option value="${categoryMod[i].id}" selected>${categoryMod[i].name}</option>`);
                        }
                    });
                }
                break;
        }
    });

    $('.status-mod').click(function(){
        var id = $(this).attr('data-id');
        Swal.fire({
            title: `Tem certeza que deseja ${$(this).attr('data-type') != 'true' ? 'aprovar' : 'bloquear' }?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
               var ajax = $.ajax({
                    url: "{{ Route('mods-approved') }}",
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
          }); 
    });

    function convertHtmlDescription(data)
    {
        var teste = data;
        data = data.split("\n");
        var result = ''; 
        
        for(i = 0; data.length > i; i++){
            var str  = data[i];
            str      = `<p>${str}</p>`;
            result   = result + str;
        }
        return result;
    }
</script>
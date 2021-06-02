
<script type="text/javascript" defer>
    @if(Auth::check() && Auth::user()->active)
        $('#submit-message').on('click', function(e){
            var image = "{{ auth()->user()->image != null ? Route('index').'/'.'images/'.auth()->user()->image : mix('images/user.png') }}";
            var name = "{{ Auth::user()->name ?? ''}}";
            $.ajax({
                url: "{{ Route('comments-create') }}",
                method:'POST',
                data: {
                    id: {{ $id ?? 0}},
                    user: {{ $user ?? 0  }},
                    message: $('#message').val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    toastr.success("Obrigado por contribuir.");
                    
                    $('.list-unstyled').append(`
                        <li class="media media-lg mt-0 pb-2 pt-2">
                            <span class="avatar avatar-md brround cover-image mr-3" data-image-src="${image}" style="background: url(${image}) center center;"></span>
                            <div class="media-body ">
                                <h5 class="mt-0 mb-1">${name}</h5>
                                <p class="text-muted">${$('#message').val()}</p>
                            </div>
                        </li>
                    `);

                    $('.reset').val('');
                }
            });
        });

        $('#like').click(function(){
            if($(this).attr('data-selected') == 'false'){
                $('#like').attr('data-selected', 'true');
                $.ajax({
                    url: "{{ Route('like-create') }}",
                    method:'POST',
                    data: {
                        id: {{ $id ?? 0}},
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data){ 
                        toastr.success("Obrigado por contribuir.") 
                        var qtdLikes = parseInt($('#qtdLikes').attr('data-qtd-like')) + 1;
                        $('#qtdLikes').html(`${qtdLikes}`)
                        $('#qtdLikes').attr('data-qtd-like', qtdLikes);
                        $('.fa-thumbs-up').addClass('text-info')
                    }
                });
            }else{
                 $('#like').attr('data-selected', 'false');
                $.ajax({
                    url: "{{ Route('like-delete') }}",
                    method:'DELETE',
                    data: {
                        id: {{ $id ?? 0}},
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data){
                        var qtdLikes = parseInt($('#qtdLikes').attr('data-qtd-like')) - 1;
                        $('#qtdLikes').html(`${qtdLikes}`);
                        $('#qtdLikes').attr('data-qtd-like', qtdLikes);
                        $('.fa-thumbs-up').removeClass('text-info')
                    }
                });
            }
            
        });
    @endif

    @if (Auth::check() && Auth::user()->active && Route::current()->getName() == 'mod-create-struture' || Auth::check() && Auth::user()->active && Route::current()->getName() == 'mods-edit')
        var filesAdd = [];
        var firstUpImage = false;
        var filesUrl = [];
        $('.img-mod').change(function(){
            const element   = $(this);
            const total     = $(this)[0].files.length;
            var imgs        = [];
            
            if(total + filesAdd.length > 10){
                toastr.error("Ops! não pode inserir mais de 10 imagens.");
                $('#files').val('');
                return;
            }

            for(var i = 0; i < total ; i++){
                var type = $(this)[0].files[i].type;

                if(type != "image/jpeg" && type != "image/png"){
                    toastr.error("formatos permitidos jpg, png, bmp.");
                    $('#files').val('')
                    return ;
                }
            } 

            for(var i = 0; i < total ; i++){
                var files = $(this)[0].files[i];
                
                if(firstUpImage){
                    var addImg = true;
                     filesAdd.filter((e) => {
                        if($(this)[0].files[i].name == e.name){
                            addImg = false;
                            return true
                        }else{
                            return false
                        }
                    });

                    if (addImg) {
                        filesAdd.push(files);
                        generateUrlImage($(this)[0].files[i], $(this)[0].files[i].name, filesAdd.length - 1)
                    }
                }else{
                    filesAdd.push(files);
                    generateUrlImage($(this)[0].files[i], $(this)[0].files[i].name, filesAdd.length - 1)
                    firstUpImage = true;    
                }
                
            }
            $('#files').val('');
        });

        $('#img-principal-file').change(function(){
            $('#img-principal').html("");
            const element = $(this);
            const total = $(this)[0].files.length;
            var imgs    = [];
            var files = $(this)[0].files[0];

            for(var i = 0; i < total ; i++){
                var type = $(this)[0].files[i].type;
                if(type != "image/jpeg" && type != "image/png"){
                    toastr.error("formatos permitidos jpg, png, bmp.");
                    $('#files').val('')
                    return ;
                }
            }

            for(var i = 0; i < total ; i++){
                var files = $(this)[0].files[i];

                const fileReader = new FileReader();
                fileReader.onloadend = function(){
                $('#img-principal').append(`
                        <div class="col-6 col-md-3 mb-3">
                            <a class="member"> <img src="${fileReader.result}" alt="thumb1" class="thumbimg">
                                <div class="memmbername">
                                principal
                                </div>
                            </a>
                        </div>
                    `);
                };
                
                fileReader.readAsDataURL(files)
            }  
        });

        $('form').on('submit',function(e){
            e.preventDefault();

            if(filesAdd.length == 0 || $('#img-principal-file').val() == ""){
                toastr.error("Campos de imagem não podem estar vazios.");
                return;
            }
            
            $('#description').val(convertHtmlDescription($('#description-not-send').val()));
            var action = ()=>{
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
                                const total = filesAdd.length;
                                const imgs  = filesAdd;
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
                                                toastr.success("Cadastrado com sucesso")
                                                $('.reset').val('');
                                                $('#img-mods').html("");
                                                $('#img-principal').html("");
                                            }
                                        },
                                        error : function(){
                                        toastr.error("ocorreu um erro.") 
                                        }
                                    });
                                }
                            
                        },
                        error: function(data){
                            toastr.error("ocorreu um erro.")
                        }
                    });
            }
            sweetAlert('Tem certeza que deseja salvar este registro?', action);
        });

        function getCategories(categoryGame){
            $.ajax({
                url:"{{  Route('get-categories') }}",
                method:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    category_game: categoryGame
                },
                success: function(data){
                    $('#tag-select option').remove();
                    $('#category-select option').remove();

                    for(var i= 0; i < data.length ; i++){
                        $('#category-select').append(`<option value="${data[i]['key']}" selected>${data[i]['category']}</option>`);    
                    }
                }
            });
        }
        
        function getTags(categoryGame, category){
            $.ajax({
                url:"{{  Route('get-tags') }}",
                method:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    category_game: categoryGame,
                    category: category
                },
                success: function(data){
                    $('#tag-select option').remove();
                    console.log(data)
                    for(var i= 0; i < data.length ; i++){
                        $('#tag-select').append(`<option value="${data[i]['key']}" selected>${data[i]['tag']}</option>`);    
                    }
                }
            });
        }


        $('#category-game-select').change(function(){
            $('#category-select option').remove();
            getCategories($(this).val());
        });

        $('#category-select').change(function(){
            getTags($('#category-game-select').val(), $(this).val())
        });

        function generateUrlImage(file, name, key){
            const fileReader = new FileReader();
            fileReader.onloadend = function(){
                $('#img-mods').append(`
                    <div class="col-6 col-md-3 pt-2">
                        <a class="member"> <img src="${fileReader.result}" alt="thumb1" class="thumbimg">
                            <div class="memmbername">
                                <span><button type="button" class="btn btn-default delete-img" data-name="${name}" data-key="${key}"><i class="fas fa-trash-alt text-danger"></i></button></span>
                            </div>
                        </a>
                    </div>
                `);
            };

            fileReader.readAsDataURL(file);
        }

        $(document).on('click','.delete-img',function(){
            var element    = $(this);

            filesAdd = filesAdd.filter(function(elem, pos, self) {
                if(element.attr('data-key') != pos){
                    return true;
                }else{
                    return false;
                }
            });

            $('#img-mods').html('');
            for(var i = 0; i < filesAdd.length ; i++){
                generateUrlImage(filesAdd[i], filesAdd[i].name, i);
            }
        });
         $('.select2').select2();
    @endif
</script>
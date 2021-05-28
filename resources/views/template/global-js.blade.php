<script type="text/javascript" defer>
    $(document).ready(function(){
        @if(Auth::check())
            $.ajax({
                url: "{{ Route('notification-get') }}",
                method:'POST',
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.data.length > 0){
                        /*coloca o total de notificações*/
                        $('#total-notifications').append(`
                            <i class="far fa-bell"></i>
                            <span class="nav-unread badge badge-danger badge-pill">${data.data.length}</span>
                        `);
                        /*monta as notificações*/
                        for(var i = 0; data.data.length > i; i++){
                            $('#notifications-user').append(`
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary-transparent text-primary"><i class="fas fa-comment-dots"></i></i></span>
                                    <div>
                                        <span class="font-weight-bold"> ${data.data[i].title} </span>
                                    </div>
                                </a>
                            `);
                        }
                        
                    }else{
                        /*coloca o total de notificações*/
                        $('#total-notifications').append(`
                            <i class="far fa-bell"></i>
                            <span class="nav-unread badge badge-danger badge-pill">0</span>
                        `);
                        /*monta mensagem*/
                        $('#notifications-user').append(`
                            <a class="dropdown-item d-flex pb-4" href="#">
                                <div>
                                    <span>Sem notificações</span>
                                </div>
                            </a>
                        `);
                    }
                    
                },
                error: function(){
                    /*coloca o total de notificações*/
                    $('#total-notifications').append(`
                        <i class="far fa-bell"></i>
                        <span class="nav-unread badge badge-danger badge-pill">0</span>
                    `);
                    /*monta mensagem*/
                    $('#notifications-user').append(`
                        <a class="dropdown-item d-flex pb-4" href="#">
                            <div>
                                <span>Sem notificações</span>
                            </div>
                        </a>
                    `);
                }
            });
        @else
            /*coloca o total de notificações*/
            $('#total-notifications').append(`
                <i class="far fa-bell"></i>
                <span class="nav-unread badge badge-danger badge-pill">0</span>
            `);
            /*monta mensagem*/
            $('#notifications-user').append(`
                <a class="dropdown-item d-flex pb-4" href="#">
                    <div>
                        <span>Sem notificações</span>
                    </div>
                </a>
            `);
        @endif
    });

    $('.category-game').click(function(){
        $('#category-game-input').val($(this).attr('data-category-game'))
        $('#form-category').submit();
    });
    
    $('.category-mod').click(function(){
        $('#category-game-input').val($(this).attr('data-category-game'))
        $('#category-mod-input').val($(this).attr('data-category-mod'))
        $('#form-category').submit();
    });
    
    $('#search-mod').click(function(){
        if($('#param').val() != '' && $('#param').val()){
            $('#form-search-mod').submit();
        }
    });
    $('.social-icon').click(function(e){
        e.preventDefault();
        if($(this).attr('href') != ''){
            window.open($(this).attr('href'));
        }
    });

    /*coloca a tag p*/
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

    function sweetAlert(title, action){
        Swal.fire({
            title: title,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
               action();    
            }
          }); 
    }
</script>
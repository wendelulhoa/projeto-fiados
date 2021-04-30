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
                    if(data.length > 0){
                        /*coloca o total de notificações*/
                        $('#total-notifications').append(`
                            <i class="far fa-bell"></i>
                            <span class="nav-unread badge badge-danger badge-pill">${data.length}</span>
                        `);
                        /*monta as notificações*/
                        for(var i = 0; data.length > i; i++){
                            $('#notifications-user').append(`
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary-transparent text-primary"><i class="fas fa-comment-dots"></i></i></span>
                                    <div>
                                        <span class="font-weight-bold"> ${data[i].message} </span>
                                        <div class="small text-muted d-flex">
                                            ${data[i].created_at}
                                        </div>
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


    

</script>
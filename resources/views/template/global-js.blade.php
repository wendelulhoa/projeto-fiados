<script type="text/javascript" defer>
    $(document).ready(function(){
        getNotifications();
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

    $('#total-notifications').click(function(){
        $.ajax({
                url: "{{ Route('notification-disable') }}",
                method:'POST',
                data:{
                    _token: "{{ csrf_token() }}",
                    ids: $('#ids-notifications').val()
                },
                success: function(data){

                }
        });
    })

    /*
    * Converte Número para Moeda
    * params: convertNumberToCurrency(100)
    * retorno: 100,00
    */
    function convertNumberToCurrency(n, c, d, t, p = false, q = false) {
        if (p && Math.abs(parseFloat(n)).toFixed(2) == '0.00') {
            return q ? '&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;-' : '-';
        }

        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        var number = s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

        return number;
    }

    function getNotifications() {
        @if(Auth::check())
            var idsNotification =[];
            $.ajax({
                url: "{{ Route('notification-get') }}",
                method:'POST',
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.data.length > 0){
                        $('#total-notifications').html('');
                        $('#notifications-user').html('');

                        /*coloca o total de notificações*/
                        $('#total-notifications').append(`
                            <i class="far fa-bell"></i>
                            <span class="nav-unread badge badge-danger badge-pill">${data.data.length}</span>
                        `);
                        /*monta as notificações*/
                        for(var i = 0; data.data.length > i; i++){
                            idsNotification.push(data.data[i].id)
                            
                            $('#notifications-user').append(`
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary-transparent text-primary"><i class="fas fa-comment-dots"></i></i></span>
                                    <div>
                                        <span class="font-weight-bold"> ${data.data[i].title} </span>
                                    </div>
                                </a>
                            `);
                        }
                        $('#ids-notifications').val(idsNotification)
                    }else{
                        $('#total-notifications').html('');
                        $('#notifications-user').html('');

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
    }

    var naoVou = 0;
    var vou    = 0;

    for(var i = 0; i < 100; i++) {
       if(Math.floor(Math.random() * (2 - 0)) == 0) {
            naoVou++;
       } else {
            vou++;
       }
    }

    console.log(`vou : ${vou}`, `não vou : ${naoVou}`);
</script>
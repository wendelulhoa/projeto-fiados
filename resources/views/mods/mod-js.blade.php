
<script type="text/javascript" defer>
    @if(Auth::check())
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
                    alert('sucesso')
                    
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
                        alert('sucesso')
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
                        alert('sucesso')
                        var qtdLikes = parseInt($('#qtdLikes').attr('data-qtd-like')) - 1;
                        $('#qtdLikes').html(`${qtdLikes}`);
                        $('#qtdLikes').attr('data-qtd-like', qtdLikes);
                        $('.fa-thumbs-up').removeClass('text-info')
                    }
                });
            }
            
        });
    @endif
    

    $('.jq-thumb').click(function(){
        $('#carousel-mod').carousel(parseInt($(this).attr('data-index')))
    })
</script>

<script type="text/javascript" defer>
    @if(Auth::check())
        $('#submit-message').on('click', function(e){
            var image = "{{ Route('index') . mix('images/user.png') }}";
            var name = "{{ Auth::user()->name ?? ''}}";
            $.ajax({
                url: "{{ Route('comments-create') }}",
                method:'POST',
                data: {
                    id: {{ $id ?? 0}},
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
    @endif
    
</script>

<script type="text/javascript" defer>
    $('form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('data-route'),
            method:'POST',
            data: {
                id: {{ $id ?? 0}},
                message: $('#message').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(data){
                alert('sucesso')
                $('.reset').val('');
            }
        });
    });
</script>
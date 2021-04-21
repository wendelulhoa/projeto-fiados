
<script type="text/javascript" defer>
    
    $('form').on('submit',function(e){
        e.preventDefault()

        $.ajax({
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
    });

</script>
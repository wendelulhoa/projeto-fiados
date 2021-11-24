<script >

    /* Busca e monta as compras na tabela. */ 
    function searchPurchases(paymentId) {
        /* Configura o csrf*/ 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{Auth::user()->type_user == 0 ? route('purchases-client-getpurchases') : route('purchases-getpurchases')}}",
            method: "GET",
            data: {
                payment_id : paymentId
            },
            success: function(data){
                if(data.length !== 0) {
                    $('#purchases-modal').html(data);
                    $('#purchase-modal').modal('show')
                } else {
                    toastr.warning("Ops! não foi encontrado nenhuma compra.")
                }
            }, 
            error: function(data){
                toastr.error("Ops! ocorreu um erro contate o administrador.")
            }
        });
    }

</script>
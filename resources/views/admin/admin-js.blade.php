
<script type="text/javascript" defer>
    $('#cpf').mask('000.000.000-00');
    $('#phone').mask('(00)00000-0000');

    $('#amount').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $('#limit').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

    /* Link para navegar entre periodos. */ 
    var linkUpdate = "{{ Route('admin-index', [0, 0]) }}";
</script>
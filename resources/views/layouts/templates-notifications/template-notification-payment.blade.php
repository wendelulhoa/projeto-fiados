<p>
    <strong>Cliente : </strong> {{$client[0]->name}} - {{formatCpf($client[0]->cpf)}} <br/>
    <strong>Criado por :</strong> {{Auth::user()->name}}    <br/>
    <strong>Valor pago :</strong> {{moneyConvert($amount)}} <br/>
    <strong>Resumo :</strong> {{$note}} <br/>
</p>
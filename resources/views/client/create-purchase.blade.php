@extends('template.index')

@section('content')
    @if ($id == null)
        @include('client.components.select-user')
    @else
        <div class="row">
            @include('layouts.card-values', ['title' => 'limite', 'value'   => $limit])
            @include('layouts.card-values', ['title' => 'Em aberto', 'value' =>"R$: ". moneyconvert($openPayment->amount ?? 0.00), 'idAlterText' => 'open-payment'])
        </div>
        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Cadastrar nova compra.</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin-store-purchases')}}" method="post" id="purchase-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Cliente</label>
                                        <input type="text" class="form-control" value="{{$client[0]->name}} - {{formatCpf($client[0]->cpf)}}" disabled>
                                        <input type="text" name="client" value="{{$id}}" hidden>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Valor compra</label>
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="valor">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Resumo (opcional)</label>
                                    <textarea class="form-control" name="note" rows="4" placeholder="Escreva um breve resumo..."></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #global-loader{
            background: rgba(10,23,55,0.5);
            padding-top: 200px;
            
        }
    </style>
@endsection
@section('script-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.select2').select2({width:'100%'});


    $('#next-page').click(function(){
        var id = $('#clients').val();
        var linkUpdate = "{{route('admin-create-purchases', ['id'=>0])}}";
        window.location.href = linkUpdate.replace('purchase/0', `purchase/${id}`)
    })

    $('#purchase-form').submit(function(e) {
        e.preventDefault();

        if($('#amount').val() == '') {
            toastr.warning('Ops! campo de valor não pode estar vazio.')
            return;
        }

        var action = ()=>{
            $.ajax({
                url: "{{ route('admin-store-purchases')}}",
                method:'POST',
                data: $(this).serialize(),
                success: function(data){
                    toastr.success("Salvo com sucesso!") 
                    if(data.amount != undefined) {
                        $('#open-payment').text('R$: ' + data.amount)
                    }
                },
                error: function(data){
                    if(data.responseJSON.message != undefined) {
                        toastr.error(data.responseJSON.message) 
                    } else {
                        toastr.error('Ops! verifique se as senhas então corretas e tente novamente.') 
                    }
                }
            });
        };
        sweetAlert(`Tem que deseja realizar esta compra ?`, action);
    });
</script>
@endsection
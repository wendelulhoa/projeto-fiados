@extends('template.index')

@section('content')

<!--Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Cadastro de cliente</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-store-client')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" placeholder="nome" value="{{old('name') ?? ''}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label">data de nascimento</label>
                                <input type="date" class="form-control" name="birth" placeholder="data de nascimento" value="{{old('birth') ?? ''}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">cpf</label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" value="{{old('cpf') ?? ''}}" name="cpf" id="cpf" placeholder="cpf" required>
                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Verifique se o cpf foi inserido corretamente</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">limite</label>
                                <input type="text" class="form-control" name="limit" value="{{old('limit') ?? ''}}" id="limit" placeholder="limite" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email (opcional)</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? ''}}" placeholder="email.">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Ops! esse email está sendo usado.</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telefone (opcional)</label>
                                <input type="text" class="form-control" id="phone" value="{{old('phone') ?? ''}}" name="phone" placeholder="telefone">
                                <div class="invalid-feedback">numero incorreto</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password" placeholder="senha" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-css')
    <style>
        #global-loader{
            background: rgba(10,23,55,0.5);
            padding-top: 200px;
            
        }
    </style>
@endsection
@section('script-js')
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.select2').select2({width:'100%'});
</script>
@endsection
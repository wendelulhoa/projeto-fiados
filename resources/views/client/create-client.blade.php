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
                <div class="card-options">
                    <a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <span class="fe fe-more-horizontal fs-20"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#"><i class="fe fe-eye mr-2"></i>View</a></li>
                        <li><a href="#"><i class="fe fe-plus-circle mr-2"></i>Add</a></li>
                        <li><a href="#"><i class="fe fe-trash-2 mr-2"></i>Remove</a></li>
                        <li><a href="#"><i class="fe fe-download-cloud mr-2"></i>Download</a></li>
                        <li><a href="#"><i class="fe fe-settings mr-2"></i>More</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-store-client')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" placeholder="nome">
                            </div>
                            <div class="form-group">
                                <label class="form-label">data de nascimento</label>
                                <input type="date" class="form-control" name="birth" placeholder="data de nascimento" value="">
                            </div>
                            <div class="form-group">
                                <label class="form-label">cpf</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="cpf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email (opcional)</label>
                                <input type="text" class="form-control" name="email" placeholder="email.">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="telefone">
                                <div class="invalid-feedback">numero incorreto</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password" placeholder="senha">
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
@endsection
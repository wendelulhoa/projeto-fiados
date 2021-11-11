@extends('template.index')

@section('content')
<!--Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Cadastrar nova compra.</h3>
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
                <form action="{{ route('admin-store-purchases')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Clientes</label>
                                <select class="form-control custom-select select2 select2-hidden-accessible" name="client" id="clients">
                                    @foreach ($clients as $item)
                                        <option value="{{$item->user_id}}">{{$item->name}} - {{$item->cpf}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Valor compra</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="valor">
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
<script>$('.select2').select2({width:'100%'});</script>
@endsection
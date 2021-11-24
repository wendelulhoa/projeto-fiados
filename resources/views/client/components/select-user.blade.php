<!--Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Selecione um usuario.</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Clientes</label>
                            <select class="form-control custom-select select2 select2-hidden-accessible" name="client" id="clients">
                                @foreach ($clients as $item)
                                    <option value="{{$item->user_id}}">{{$item->name}} - {{formatCpf($item->cpf)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right" id="next-page">Prosseguir</button>
            </div>
        </div>
    </div>
</div>
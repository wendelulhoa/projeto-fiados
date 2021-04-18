<div class="col-xl-12 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                {!! $icon ?? '' !!}
                <div class="text-secondary">
                    <form action="{{ Route('mods-create') }}" id="mod" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Titulo</label>
                                <input type="text" name="name" class="form-control" id="" placeholder="Titulo">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">link mod</label>
                                <input type="text" name="mod-link" class="form-control" id="" placeholder="link do mod">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Categoria</label>
                                <select id="category" class="form-control">
                                    <option selected>Selecione</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Tag</label>
                                <select id="category" class="form-control">
                                    <option selected>Selecione</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                                Files: <input type="file" id="file" name="file" multiple><br />

                                <div id="selectedFiles"></div>
                        </div>
                        <div class="form-row">
                            <textarea class="form-control mb-2" id="text-area" name="description" rows="5"
                                placeholder="descrição..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary ">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
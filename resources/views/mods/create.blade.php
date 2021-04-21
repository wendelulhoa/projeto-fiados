<div class="col-xl-12 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                {!! $icon ?? '' !!}
                <div class="text-secondary">
                    <form data-route="{{ Route('mods-create') }}" id="mod" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Titulo</label>
                                <input type="text" name="name" class="form-control reset" id="" placeholder="Titulo">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">link mod</label>
                                <input type="text" name="link" class="form-control reset" id="" placeholder="link do mod">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Categoria</label>
                                <select id="category" class="form-control reset" name="category">
                                    <option selected>Selecione</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Tag</label>
                                <select id="category" class="form-control reset" name="tag">
                                    <option selected>Selecione</option>
                                    @foreach ($tags as $item)
                                        <option value="{{ $item->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                                Files: <input type="file" class="reset" id="file" name="file" multiple><br />

                                <div id="selectedFiles"></div>
                        </div>
                        <div class="form-row">
                            <textarea class="form-control mb- reset" id="text-area" name="description" rows="5"
                                placeholder="descrição..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary ">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form data-route="{{ Route('mods-create') }}" id="mod" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group ">
        <div class="form-group col-md-12">
            <label for="name" class="">Titulo</label>
            <input type="text" name="name"  id="title" class="form-control reset" value="" placeholder="Digite um titulo" required/>
        </div>
        <div class="form-group col-md-12">
            <label for="">link mod</label>
            <input type="text" name="link" class="form-control reset" id="" placeholder="link do mod">
        </div>    
            <div class="form-group col-md-12">
                <label for="category-game-select">Categoria do jogo</label>
                <select id="category-game-select" class="form-control reset select2" name="category-game">
                    <option selected>Selecione</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="category-select">Categoria</label>
                <select id="category-select" class="form-control reset select2" name="category">
                    <option selected>Selecione</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="tag-select">Tag</label>
                <select id="tag-select" class="form-control reset" name="tag">
                    <option selected>Selecione</option>
                </select>
            </div>
        <div class="form-group col-md-12">
            <label for="">Imagem da tela principal</label><br />
            principal: <input type="file" class="reset img-mod" id="img-principal" name="principal-img"><br />
        </div>
        <div class="form-group col-md-12">
            <label for="">pressione ctrl para selecionar varias imagens</label><br />
            Images: <input type="file" class="reset img-mod" id="files" name="files[]" multiple><br />
        </div>
        <div class="form-row col-md-12">
            <textarea class="form-control mb- reset" id="description-not-send"  value="" rows="5"
                placeholder="descrição..." required></textarea>
            <input type="text" name="description" id="description" value="" hidden>
        </div>
    </div>
<div class="row" id="img-mods">
    
</div>
        <button type="submit" id="teste" class="btn btn-primary float-right ml-2">Salvar</button>
</form>

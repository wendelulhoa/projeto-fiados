<form class="pt-2" data-route="{{ $route }}" name="form-{{ $id }}" id="form-{{ $id }}">
{{csrf_field()}}
<div class="form-group ">
    <label for="{{ $name ?? '' }}" class="sr-only">{{ $name ?? '' }}</label>
    <input type="text" name="{{ $id }}"  id="{{ $id ?? '' }}" class="form-control reset" value="{{ isset($content) && !empty($content) ? $content[0]->name : ''  }}" placeholder="{{ $placeholder }}" required/>
</div>
    <button type="submit" class="btn btn-primary float-right ml-2">Salvar</button>
</form>
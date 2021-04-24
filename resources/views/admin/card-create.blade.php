<div class="col-xl-8 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                {!! $icon ?? '' !!}
                <div class="text-right text-secondary">
                    <form class="form-inline" data-route="{{ $route }}" name="form-{{ $id }}" id="form-{{ $id }}">
                        {{csrf_field()}}
                        <div class="form-group mb-2">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{ $name ?? '' }}"
                                disabled>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="{{ $name ?? '' }}" class="sr-only">{{ $name ?? '' }}</label>
                            <input type="text" name="{{ $id }}" class="form-control reset" id="{{ $id ?? '' }}" value="{{ isset($content) && !empty($content) ? $content[0]->name : ''  }}" placeholder="{{ $placeholder }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
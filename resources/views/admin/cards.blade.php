<div class="col-xl-3 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                {!! $icon ?? '' !!}
                <div class="text-right text-secondary">
                    <h5>{{ $name ?? '' }}</h5>
                    <h3>{{ $total ?? ''}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
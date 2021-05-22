{{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-8 p-2">
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
</div> --}}

<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
    <div class="card">
        <div class="card-body text-center list-icons">
            {!! $icon ?? '' !!}
            <p class="card-text mt-3 mb-3">{{ $name ?? '' }}</p>
            <p class="h2 text-center  text-secondary">{{ $total ?? ''}}</p>
        </div>
    </div>
</div>
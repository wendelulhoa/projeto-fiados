<div class="col-md-12 col-lg-12 col-xl-4">
    <div class="card overflow-hidden">
        <div class="card-header">
            <div>
                <h3 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$title ?? ''}}</font></font></h3>
            </div>
            <div class="card-options">
                @if (isset($link) && !empty($link))
                    <a href="{{$link ?? ''}}"><i class="fe fe-eye mr-2"></i>Visualizar todos</a>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <div class="list-group projects-list">
                @foreach ($content as $item)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-0">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 font-weight-sembold text-dark"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->name }}</font></font></h6>
                            <h6 class="text-dark mb-0 font-weight-sembold text-dark"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{'R$: ' . moneyConvert($item->amount ?? 0.00)}}</font></font></h6>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span>
                            <span class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</font></font></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
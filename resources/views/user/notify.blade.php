@extends('template.index')
@section('content')
<div class="col-md-12 m-b-30">
    <ul class="timelineleft pb-5">
        @foreach ($notifications as $item)
            <li>
                <i class="fa fa-comments bg-warning"></i>
                <div class="timelineleft-item">
                    <span class="time"><i class="fa fa-clock-o text-danger"></i>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</span>
                    <h3 class="timelineleft-header"><span class="text-muted">{{ $item->title }}</span></h3>
                    <div class="timelineleft-body">
                        {!! $item->message !!}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="pt-2">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
@extends('template.index')

@section('content')
    @php
        $content = json_decode($post[0]['content']);
        $content = $content->content;
    @endphp
    <h1>{{$post[0]->title}}</h1>
    <div class="row mt-3">
        <span class="avatar avatar-md brround cover-image mr-3" data-image-src="{{ $post[0]->image != null ? Route('index').'/'.'images/'.$post[0]->image : mix('images/user.png') }}"></span>
        <h5 class=" mt-3 text-muted">{{ $post[0]->author }}</h5><br/>
    </div>
    <small class="d-block text-muted pl-4 ml-5">{{ date_format($post[0]->created_at ,'d/m/Y') }}</small>
    <div class="col">
        <div class="row">
            <div class="col-xl-9 col-lg-12 col-md-12">
                <hr style="border-top: 1px solid grey">
                @if (!empty($post[0]->image_principal))
                    <img class="pb-3" src="{{Route('index').'/resize/1120-420-80/'.$post[0]->image_principal}}" alt="{{$post[0]->title}}" >
                @endif
                {!!$content!!}
            </div>
            <div>   
                <h4>teste</h4>
            </div>
        </div>
    </div>

    @section('script-css')
        <style>
            p, h1, h2, h4, h5, h6{
                background-color: #F0F1F6 !important; 
            }
        </style>
    @endsection
@endsection
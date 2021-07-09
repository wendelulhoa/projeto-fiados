@extends('template.index')

@section('content')
<div class="row m-2 mr-5 pr-5">
    @foreach ($posts as $item)
        @include('layouts.card-notice', ['author'=>$item->author,'title'=>$item->title, 'content'=>$item->text_post])
    @endforeach

</div>
<div class="pt-2">
    {{ $posts->links() }}
</div>
@section('script-css')
@endsection
@endsection
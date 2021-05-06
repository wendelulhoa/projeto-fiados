@extends('template.index')

@section('content')
    <div class="row m-2 mr-5 pr-5">
        @include('mods.card-mods', compact('mods'))
        
    </div>
    <div class="pt-2" >
            {{ $mods->links() }}
    </div>
@endsection

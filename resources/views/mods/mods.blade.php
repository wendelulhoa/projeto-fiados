@extends('layouts.app')

@section('content')
    <div class="row m-2 mr-5 pr-5">
        @include('mods.card-mods', compact('mods'))
    </div>
@endsection

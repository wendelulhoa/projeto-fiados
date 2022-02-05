@extends('template.index')

@section('content')

@include('mods.table',compact('mods'))
@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
@endsection

@endsection
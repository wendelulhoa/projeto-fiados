@extends('template.index')

@section('content')

@include('posts.table',compact('posts'))
@section('script-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('admin.admin-js')
@endsection

@endsection
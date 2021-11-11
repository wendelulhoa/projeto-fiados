@extends('template.index')
 
 
@section('content')
    @include('client.components.table-open-payments')

    @include('layouts.modal-purchases')

    @include('client.client-js')

@endsection

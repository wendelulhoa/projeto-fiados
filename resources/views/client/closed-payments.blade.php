@extends('template.index')
 
 
@section('content')
    @include('client.components.table-closed-payments')
    
    @include('layouts.modal-purchases')

    @include('client.client-js')
@endsection

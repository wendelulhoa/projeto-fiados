@extends('template.index')
 
 
@section('content')
    @include('client.components.table-closed-payments')
    
    @include('layouts.modal-purchases')

    
    @section('script-js')
        @include('client.client-js')
        <script>
            /* Link para navegar entre periodos. */ 
            var linkUpdate = "{{ Route('admin-closed-payments', [0, 0]) }}";
        </script>
    @endsection
@endsection

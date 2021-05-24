@extends('template.index')

@section('content')
<div class="row m-2 mr-5 pr-5">
    @include('mods.card-mods', compact('mods'))

</div>
<div class="pt-2">
    {{ $mods->links() }}
</div>
@section('script-css')
<style>
    .preview,
    .img-responsive {
        width: 100%;
        border-radius: 4px;
        height: 175px;
        object-fit: cover;
    }

    .cartao {
        box-shadow: 1px 2px 5px #999;
        transition: all .4s;
    }

    .cartao:hover {
        box-shadow: 2px 3px 15px #999;
        transform: translateY(-1px);
    }

    .borda-arredondada {
        border-radius: 20px;
    }

    .product-info {
        left: 13% !important;
        bottom: 50%;
    }
</style>
@endsection
@endsection
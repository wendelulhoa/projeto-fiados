@extends('template.index')

@section('content')

    {{-- CARDS SUPERIORES --}}
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 col-lg-8 col-md-8 col-sm-10  ml-auto">
                    <div class="row pt-md-2 mt-md-3 mb-5">
                        @include('layouts.cards', ['name'=>'Downloads', 'total'=>20000, 'icon'=> '<i class="fas fa-download fa-3x text-success"></i>'])
                        @include('layouts.cards', ['name'=>'Mods', 'total'=>25, 'icon'=> '<i class="fas fa-3x fa-car"></i>'])
                        @include('layouts.cards', ['name'=>'Favoritos', 'total'=> 20, 'icon'=>'<i class="fas fa-star fa-3x text-warning"></i>'])
                        @include('layouts.cards', ['name'=>'Curtidas', 'total'=> 2000, 'icon'=>'<i class="fas fa-3x fa-thumbs-up text-info"></i>'])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
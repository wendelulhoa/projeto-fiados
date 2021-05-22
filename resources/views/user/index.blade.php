@extends('template.index')

@section('content')

            <div class="row">
                @include('layouts.cards', ['name'=>'Downloads', 'total'=>20000, 'icon'=> '<i class="fas fa-download fa-3x text-success"></i>'])
                @include('layouts.cards', ['name'=>'Mods', 'total'=>25, 'icon'=> '<i class="fas fa-3x fa-car"></i>'])
                @include('layouts.cards', ['name'=>'Favoritos', 'total'=> 20, 'icon'=>'<i class="fas fa-star fa-3x text-warning"></i>'])
                @include('layouts.cards', ['name'=>'Curtidas', 'total'=> 2000, 'icon'=>'<i class="fas fa-3x fa-thumbs-up text-info"></i>'])
            </div>
@endsection
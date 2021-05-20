@extends('template.index')

@section('content')
@php
    $images      = json_decode($mod[0]->images);
    $quantImages = count($images) ?? 0;
@endphp
<div class="row row-cards">
    <div class="col-lg-12 col-xl-9">
        <div class="card">
            <div class="card-body single-productslide">
                <div class="product-gallery border">
                    <div class="product-item text-center">
                        <div id="carousel-mod" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($images as $key => $item)
                                    <li data-target="#carousel-mod" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($images as $key => $item)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ Route('index').'/'.$item->path ?? '' }}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                                
                            </div>
                            <a class="carousel-control-prev" href="#carousel-mod" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-mod" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    @foreach ($images as $item)
                        <div class="col-6 col-md-3">
                            <a data-index="{{ $loop->index }}"  class="thumbnail jq-thumb">
                                <img src="{{ Route('index').'/'.$item->path ?? '' }}" alt="thumb1" class="thumbimg">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="product-gallery-data mb-0">
                    <h3 class="mb-3 font-weight-semibold">{{ $mod[0]->name ?? 'ocorreu um erro informe ao suporte, logo resolveremos.' }}</h3>
                    <a class="btn  btn-default" id="like" data-selected="{{ $likeSelect ? 'true' : 'false' }}"><i class="fas fa-thumbs-up {{ $likeSelect ? 'text-info' : '' }}"></i> curtir <span class="badge badge-info" id="qtdLikes" data-qtd-like='{{ $totalLikes ?? 0 }}'> {{ $totalLikes ?? 0 }}</span></a>
                    <a href="{{ $mod[0]->link ?? '' }}" class="btn  btn-success"> <i class="fas fa-download fa-1x"></i> Download</a>
                    <div class="product-gallery-rats">
                        <ul class="product-gallery-rating">
                            <li>
                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                <a href="#"><i class="fa fa-star-o text-warning"></i></a>
                            </li>
                        </ul>
                        <div class="label-rating ml-2">793 reviews</div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1 ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab5" class="active" data-toggle="tab">Descrição</a></li>
                                <li><a href="#tab6" data-toggle="tab">Comentários</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">
                                <h6 class="font-weight-semibold mt-3">DESCRIÇÃO</h6>
                                <p class="text-muted">{{ $mod[0]->description ?? 'ocorreu um erro informe ao suporte, logo resolveremos.' }}<p>
                            </div>
                            <div class="tab-pane " id="tab6">
                                <ul class="list-unstyled">
                                    @foreach ($comments as $key => $item)
                                        <li class="media media-lg mt-0 pb-2 pt-2">
                                            <span class="avatar avatar-md brround cover-image mr-3" data-image-src="{{ mix('images/user.png') }}"></span>
                                            <div class="media-body ">
                                                <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                                                <p class="text-muted">{{ $item->message }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                    
                                </ul>

                                <div class="msb-reply d-flex">
                                    <textarea placeholder="escreve um comentário..." id="message" name="message" class="reset"></textarea>
                                    <button type="submit" id="submit-message"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn  btn-success"> <i class="fas fa-download fa-1x"></i> Download</a>
            </div>
        </div>
        
    </div>
    <div class="col-lg-3">
            @include('mods.card-mods', ['mods'=> $mods, 'type'=> 1])
            
	</div>
			
        

</div>
    @section('script-js')
        @include('mods.mod-js')
    @endsection
@endsection
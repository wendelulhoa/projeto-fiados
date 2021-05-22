@extends('template.index')

@section('content')
@php
$images = json_decode($mod[0]->images);
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

                                <li data-target="#carousel-mod" data-slide-to="{{ $key }}"
                                    class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach

                            </ol>
                            <div class="carousel-inner">
                                @foreach ($images as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ Route('index').'/'.$item->path ?? '' }}" class="d-block w-100"
                                        alt="...">
                                </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#carousel-mod" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-mod" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    @foreach ($images as $item)
                    <div class="col-6 col-md-3">
                        <a data-index="{{ $loop->index }}" class="thumbnail jq-thumb">
                            <img src="{{ Route('index').'/'.$item->path ?? '' }}" alt="thumb1" class="thumbimg">
                        </a>
                    </div>
                    @endforeach

                </div>

                <div class="product-gallery-data mb-0">
                    <h3 class="mb-3 font-weight-semibold">
                        {{ $mod[0]->name ?? 'ocorreu um erro informe ao suporte, logo resolveremos.' }}</h3>
                    <a class="btn  btn-default" id="like" data-selected="{{ $likeSelect ? 'true' : 'false' }}"><i
                            class="fas fa-thumbs-up {{ $likeSelect ? 'text-info' : '' }}"></i> curtir <span
                            class="badge badge-info" id="qtdLikes" data-qtd-like='{{ $totalLikes ?? 0 }}'>
                            {{ $totalLikes ?? 0 }}</span></a>
                    <a href="{{ $mod[0]->link ?? '' }}" class="btn  btn-success"> <i class="fas fa-download fa-1x"></i>
                        Download</a>
                    <button type="button" class="btn btn-default"><i class="fa fa-star text-warning"></i>Estrelas <span
                            class="badge badge-warning">
                            {{ $totalLikes ?? 0 }}</span></button>
                    <div class="product-gallery-rats">
                        <ul class="product-gallery-rating">
                            <li>
                                Avaliar
                                <fieldset class="rating"> <input type="radio" id="star5" name="rating"
                                        value="5" /><label class="full" for="star5"
                                        title="Awesome - 5 stars"></label> <input type="radio" id="star4half"
                                        name="rating" value="4.5" /><label class="half" for="star4half"
                                        title="Pretty good - 4.5 stars"></label> <input type="radio" id="star4"
                                        name="rating" value="4" /><label class="full" for="star4"
                                        title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" name="rating" value="3.5" /><label
                                        class="half" for="star3half" title="Meh - 3.5 stars"></label> <input
                                        type="radio" id="star3" name="rating" value="3" /><label class="full"
                                        for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" name="rating" value="2.5" /><label
                                        class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class="full"
                                        for="star2" title="Kinda bad - 2 stars"></label> <input type="radio"
                                        id="star1half" name="rating" value="1.5" /><label class="half"
                                        for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class="full"
                                        for="star1" title="Sucks big time - 1 star"></label> <input type="radio"
                                        id="starhalf" name="rating" value="0.5" /><label class="half"
                                        for="starhalf" title="Sucks big time - 0.5 stars"></label> <input
                                        type="radio" class="reset-option" name="rating" value="reset" />
                                        
                                </fieldset>
                            </li>
                        </ul>
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
                                <p class="text-muted">{!! $mod[0]->description ?? 'ocorreu um erro informe ao suporte,
                                    logo resolveremos.' !!}<p>
                            </div>
                            <div class="tab-pane " id="tab6">
                                <ul class="list-unstyled">
                                    @foreach ($comments as $key => $item)
                                    <li class="media media-lg mt-0 pb-2 pt-2">
                                        <span class="avatar avatar-md brround cover-image mr-3"
                                            data-image-src="{{ $item->image != null ? Route('index').'/'.'images/'.$item->image : mix('images/user.png') }}"></span>
                                        <div class="media-body ">
                                            <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                                            <p class="text-muted">{{ $item->message }}</p>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>

                                <div class="msb-reply d-flex">
                                    <textarea placeholder="escreve um comentário..." id="message" name="message"
                                        class="reset"></textarea>
                                    <button type="submit" id="submit-message"><i
                                            class="fas fa-paper-plane"></i></button>
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
<script type='text/javascript'>
    $(document).ready(function () {
        $("input[type='radio']").click(function () {
            var value = $("input[type='radio']:checked").val();
            if (value < 3) { 
                $('.myratings').css('color', 'red'); 
                $(".myratings").text(value); 
            } else { 
                $('.myratings').css('color', 'green'); 
                $(".myratings").text(value); 
            }
        });
    });
</script>
@endsection

@section('script-css')
<style>
    @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);



    .rating {
        border: none;
        margin-right: 49px
    }

    .myratings {
        font-size: 85px;
        color: green
    }

    .rating>[id^="star"] {
        display: none
    }

    .rating>label:before {
        margin: 5px;
        font-size: 1em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005"
    }

    .rating>.half:before {
        content: "\f089";
        position: absolute
    }

    .rating>label {
        color: #ddd;
        float: right
    }

    .rating>[id^="star"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }

    .rating>[id^="star"]:checked+label:hover,
    .rating>[id^="star"]:checked~label:hover,
    .rating>label:hover~[id^="star"]:checked~label,
    .rating>[id^="star"]:checked~label:hover~label {
        color: #FFED85
    }

    .reset-option {
        display: none
    }

    .reset-button {
        margin: 6px 12px;
        background-color: rgb(255, 255, 255);
        text-transform: uppercase
    }

    .mt-100 {
        margin-top: 100px
    }
    .product-gallery .product-item img {
        height: 450px;
    }
</style>
@endsection

@endsection
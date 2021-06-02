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
                <div class="tz-gallery row">
                <div class="product-gallery">
                    <div class="text-center">
                        <a class="lightbox" style="margin-bottom: 10px;" href="{{ Route('index').'/resize/1280-720-90'.'/'.$images[0]->path .'' ?? '' }}">
                            <img src="{{ Route('index').'/resize/850-450-70'.'/'. $images[0]->path ?? '' }}" alt="{{ $mod[0]->name }}">
                        </a>  
                    </div>
                </div>
                    <div class="row pt-3">
                        @foreach ($images as $item)
                            @if ($images[0]->path != $item->path)
                                <div class="col-sm-3 col-md-3">
                                    <a class="lightbox" href="{{ Route('index').'/resize/1280-720-90'.'/'.$item->path .'' ?? '' }}">
                                        <img class="img-ajust" src="{{ Route('index').'/resize/350-233-60'.'/'.$item->path .'' ?? '' }}" alt="{{ $mod[0]->name }}">
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        @if ($mod[0]->link_video != '')
                            <div class="col-sm-3 col-md-3">
                                <a class="lightbox" target="_blank"  style="margin-bottom: 10px;" href="{{ $mod[0]->link_video }}">
                                    <img src="{{ Route('index').'/resize/850-450-70'.'/'. $images[0]->path ?? '' }}" alt="{{ $mod[0]->name }}">
                                    <span class="far fa-play-circle fa-4x" style="position: absolute; top: 15%; right: 40%; color: white;"></span>
                                </a>  
                            </div>
                        @endif
                    </div>
                </div>

                <div class="product-gallery-data mb-0">
                    <h3 class="mb-3 font-weight-semibold">
                        {{ $mod[0]->name ?? 'ocorreu um erro informe ao suporte, logo resolveremos.' }}</h3>
                    <button class="btn  btn-default mt-2" id="like" data-selected="{{ $likeSelect ? 'true' : 'false' }}"><i
                            class="fas fa-thumbs-up {{ $likeSelect ? 'text-info' : '' }}"></i> curtir <span
                            class="badge badge-info" id="qtdLikes" data-qtd-like='{{ $totalLikes ?? 0 }}'>
                            {{ $totalLikes ?? 0 }}</span></button>
                    <a href="{{ $mod[0]->link ?? '' }}"  target="_blank" class="btn  btn-default mt-2 download"> <i class="fas fa-download text-success fa-1x"></i>
                        Download <span id="qtdDownloads" data-qtd-downloads="{{ $mod[0]->total_downloads ?? 0 }}"
                            class="badge badge-success">
                            {{ $mod[0]->total_downloads ?? 0 }}</span></a>
                    <button class="btn btn-default mt-2" ><i class="fa fa-star text-warning"></i>Estrelas <span
                            class="badge badge-warning" id="qtdStars" data-qtd-stars='{{ $totalStars ?? 0 }}' data-users="{{ $mod[0]->total_users_stars ?? 0 }}">
                            {{ $totalStars ?? 0 }}</span></button>
                    <div class="product-gallery-rats">
                        <ul class="product-gallery-rating">
                            <li>
                                Avaliar
                                <fieldset class="rating" id="star" data-selected="{{ $starSelect ? 'true' : 'false' }}"> 
                                <input type="radio" id="star5" name="rating" value="5" {{ $starSelect ? 'disabled' : '' }}  {{ isset($star[0]->stars) &&$star[0]->stars == 5 ? 'checked' : ''  ?? ''}}/>
                                <label class="full" for="star5" title="Awesome - 5 stars"></label> 
                                
                                <input type="radio" id="star4half" name="rating" value="4.5" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 4.5 ? 'checked' : '' }}/>
                                <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> 
                                
                                <input type="radio" id="star4" name="rating" value="4" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 4 ? 'checked' : '' }}/>
                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                
                                <input type="radio" id="star3half" name="rating" value="3.5" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 3.5 ? 'checked' : '' }} />
                                <label class="half" for="star3half" title="Meh - 3.5 stars"></label> 
                                
                                <input type="radio" id="star3" name="rating" value="3" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 3 ? 'checked' : '' }} />
                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                
                                <input type="radio" id="star2half" name="rating" value="2.5" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 2.5 ? 'checked' : '' }} />
                                <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label class="full" for="star2" title="Kinda bad - 2 stars" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 2 ? 'checked' : '' }} ></label> 
                                
                                <input type="radio" id="star1half" name="rating" value="1.5" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 1.5 ? 'checked' : '' }} />
                                <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                
                                <input type="radio" id="star1" name="rating" value="1" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 1 ? 'checked' : '' }}/>
                                <label class="full"for="star1" title="Sucks big time - 1 star"></label> 
                                    
                                <input type="radio" id="starhalf" name="rating" value="0.5" {{ $starSelect ? 'disabled' : '' }} {{ isset($star[0]->stars) &&$star[0]->stars == 0.5 ? 'checked' : '' }}/>
                                
                                <label class="half"for="starhalf" title="Sucks big time - 0.5 stars"></label> 
                                <input type="radio" class="reset-option" name="rating" value="reset" />
                                    
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
                                <div class="d-flex ">
                                    <a href="{{ Route('index-'.$routesNames[$mod[0]->category_game]) }}" class="badge badge-default mr-1"><i class="fas fa-tag"></i> {{ $routesNames[$mod[0]->category_game] ?? '' }}</a>
                                    <a href="{{ Route('search-category-'.$routesNames[$mod[0]->category_game].'-and-tag', ['category'=> $categoriesModsEn[$mod[0]->category]]) }}" class="badge badge-default mr-1" ><i class="fas fa-tag"></i> {{ $categoryMod[$mod[0]->category]  ?? '' }}</a>
                                    <a  class="badge badge-default mr-1" ><i class="fas fa-tag"></i> {{ $mod[0]->tagPt ?? '' }}</a>
                                    <a class="badge badge-info mr-1" ><i class="fas fa-tag"></i>{{ $mod[0]->release ?? '' }}</a>
                                </div>
                            </div>
                            <div class="tab-pane " id="tab6">
                                <ul class="list-unstyled">
                                    @foreach ($comments as $key => $item)
                                    <li class="media media-lg mt-0 pb-2 pt-2">
                                        <span class="avatar avatar-md brround cover-image mr-3"
                                            data-image-src="{{ $item->image != null ? Route('index').'/'.'images/'.$item->image : mix('images/user.png') }}"></span>
                                        <div class="media-body ">
                                            <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                                            <div class="col">
                                                <div class="row">
                                                    <p class="text-muted">{{ $item->message }}</p>
                                                </div>
                                                    <div class="row">
                                                    @if (Auth::check() && Auth::user()->id == $item->user_id || Auth::user()->id == $mod[0]->user_id)
                                                        <a href="{{ Route('comments-delete', ['user_id'=> $item->user_id, 'id'=> $item->id, 'id_mod'=> $mod[0]->id])  }}" class="mr-2 delete-comment">excluir</a>  
                                                    @endif
                                                        {{-- <a href="" class="mr-2">editar</a>
                                                        <a href="">mencionar</a> --}}
                                                    </div>
                                            </div>
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
                                <div class="pt-2">
                                    {{ $comments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ $mod[0]->link ?? '' }}" data-qtd-downloads="{{ $mod[0]->total_downloads ?? 0 }}" target="_blank"class="btn  btn-success"> <i class="fas fa-download fa-1x"></i> Download</a>
            </div>
        </div>

    </div>
    <div class="col-lg-3">
        @include('mods.card-mods', ['mods'=> $mods, 'type'=> 1])
    </div>



</div>
@section('script-js')
@include('mods.mod-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type='text/javascript'>
    $(document).ready(function () {
        $("input[type='radio']").click(function () {
            var value = $("input[type='radio']:checked").val();
            $("input[type='radio']").attr('disabled', true);
            if($('#star').attr('data-selected') == 'false'){
                $('#star').attr('data-selected', 'true');
                $.ajax({
                    url: "{{ Route('star-create') }}",
                    method:'POST',
                    data: {
                        id: {{ $id ?? 0}},
                        "_token": "{{ csrf_token() }}",
                        total : value
                    },
                    success: function(data){ 
                        toastr.success("Obrigado por contribuir.");
                    }
                });
            } 
        });
    });
    baguetteBox.run('.tz-gallery');
    baguetteBox.run('.galery-top');

    $('.download').click(function(){
        $.ajax({
            url: "{{ Route('download', ['id'=> $id ?? 0 ]) }}",
            method:'POST',
            data: {"_token": "{{ csrf_token() }}"},
            success: function(data){ 
                toastr.success("Obrigado!");
                var total = parseInt($('#qtdDownloads').attr('data-qtd-downloads')) + 1;
                $('#qtdDownloads').html(`${total}`)
                $('#qtdDownloads').attr('data-qtd-like', total);
            }
        });
    });

    $('.delete-comment').click(function(e){
        e.preventDefault();
        var element = $(this).parent().parent().parent().parent();

        var action = ()=>{
            $.ajax({
                url: $(this).attr('href'),
                method:'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    toastr.success("Excluido com sucesso!");
                    element.remove();
                }
            });
        };

        sweetAlert(`Tem certeza que deseja excluir?`, action)
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

    .img-ajust{
       height: 74% !important; 
       width: 100% !important;
       object-fit: fill;
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
        height: 370px;
    }
    .container.gallery-container {
        background-color: #fff;
        color: #35373a;
        min-height: 100vh;
        border-radius: 20px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.06);
    }

    .gallery-container h1 {
        text-align: center;
        margin-top: 70px;
        font-family: 'Droid Sans', sans-serif;
        font-weight: bold;
    }

    .gallery-container p.page-description {
        text-align: center;
        max-width: 800px;
        margin: 25px auto;
        color: #888;
        font-size: 18px;
    }

    .tz-gallery {
        padding: 40px;
    }

    .tz-gallery .lightbox img {
        width: 100%;
        margin-bottom: 12px;
        transition: 0.2s ease-in-out;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
    }


    .tz-gallery .lightbox img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }

    .tz-gallery img {
        border-radius: 4px;
    }

    .baguetteBox-button {
        background-color: transparent !important;
    }


    @media(max-width: 768px) {
        body {
            padding: 0;
        }

        .container.gallery-container {
            border-radius: 0;
        }
    }
    #baguetteBox-overlay .full-image img {
        max-width: 70% !important;
    }
</style>
@endsection
@endsection
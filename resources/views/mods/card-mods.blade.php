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
    .product-info{
        left: 13% !important;
        bottom: 50%;
    }
</style>
@foreach ($mods as $key => $item)
@php
    $image = json_decode($item->images);
@endphp
@if (isset($type) && $type == 1)
    <div class="owl-item" style="width: 250.006px; margin-right: 25px; margin-top: 30px"><div class="item">
        <div class="memberblock mb-0">
            <a href="{{ Route('mods-detail',['id'=>$item->id]) }}" class="member"> <img src="{{ Route('index') . '/'. $image[0]->path }}" alt="">
                <p class="text-center">{{$item->name}}</p>
                <div class="memmbername row ml-auto">
                    <p class="text-warning mb-0">
                        <i class="fas fa-download fa-1x text-success"></i>
                        <p class="pl-2 pr-2">100</p>
                        <i class="fas fa-star text-warning"></i>
                        <p class="pl-2 pr-2">5</p>
                        <i class="fas fa-thumbs-up text-info"></i>
                        <p class="pl-2">{{ $item->total_likes ?? 0 }}</p>
                    </p>
                </div>
            </a>
        </div>
    </div></div>
@else
    <div class="col-sm-4 col-xl-4">
        <div class="card item-card">
            <div class="card-body">
                <div class="product">
                    <div class="text-center product-img">
                    <a href="{{ Route('mods-detail',['id'=>$item->id]) }}">
                        <img src="{{ Route('index') . '/'. $image[0]->path }}" alt="img" class="img-fluid img-responsive">
                    </a>
                    </div>
                    <div class=" text-center mt-4" style="text-overflow: ellipsis;">
                        <div class="text-center text-warning">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="row pt-3 ml-auto" style="padding-left: 50px">
                            <i class="fas fa-download fa-1x text-success"></i>
                            <p class="pl-2 pr-2">100</p>
                            <i class="fas fa-star text-warning"></i>
                            <p class="pl-2 pr-2">5</p>
                            <i class="fas fa-thumbs-up text-info"></i>
                            <p class="pl-2">{{ $item->total_likes ?? 0 }}</p>
                        </div>
                        <a href="{{ Route('mods-detail',['id'=>$item->id]) }}"><h5 class="mb-0 mt-2">{{$item->name}}</h5></a>
                    </div>
                    <div class="product-info">
                        <div class="d-flex ">
                            <a href="#" class="badge badge-default mr-1 category-game" data-category-game="{{ $item->category_game }}" ><i class="fas fa-tag"></i> {{ $categoryGame[$item->category_game - 1] ?? '' }}</a>
                            <a href="#" class="badge badge-default mr-1 category-mod" data-category-game="{{  $item->category_game }}" data-category-mod="{{ $item->category  }}"><i class="fas fa-tag"></i>{{ $categoryMod[$item->category - 1] ?? '' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
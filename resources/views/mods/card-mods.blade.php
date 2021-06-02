@foreach ($mods as $key => $item)
@if (isset($type) && $type == 1)
    <div class="owl-item" style="width: 250.006px; margin-right: 25px; margin-top: 30px"><div class="item">
        <div class="memberblock mb-0">
            <a href="{{ Route('mods-detail',['id'=>$item->id]) }}" class="member"> <img src="{{ Route('index') . '/'. $item->principal_image }}" alt="{{ $item->name }}">
                <p class="text-center">{{$item->name}}</p>
                <div class="memmbername row ml-auto" style="padding-left: 60px">
                    <p class="text-warning mb-0">
                        <i class="fas fa-download fa-1x text-success"></i>
                        <p class="pl-2 pr-2">{{ $item->total_downloads ?? 0 }}</p>
                        <i class="fas fa-star text-warning"></i>
                        <p class="pl-2 pr-2">{{ $item->total_users_stars == 0 ? $item->total_stars : $item->total_stars / $item->total_users_stars }}</p>
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
                        <img src="{{ Route('index') . '/'. $item->principal_image }}" alt="{{ $item->name }}" class="img-fluid img-responsive">
                    </a>
                    </div>
                    <div class=" text-center mt-4" style="text-overflow: ellipsis;">
                        <div class="row pt-3 ml-auto" style="padding-left: 90px">
                            <i class="fas fa-download fa-1x text-success"></i>
                            <p class="pl-2 pr-2">{{ $item->total_downloads ?? 0 }}</p>
                            <i class="fas fa-star text-warning"></i>
                            <p class="pl-2 pr-2">{{ $item->total_users_stars == 0 ? $item->total_stars : $item->total_stars / $item->total_users_stars}}</p>
                            <i class="fas fa-thumbs-up text-info"></i>
                            <p class="pl-2">{{ $item->total_likes ?? 0 }}</p>
                        </div>
                        <a href="{{ Route('mods-detail',['id'=>$item->id]) }}"><h5 class="mb-0 mt-2">{{$item->name}}</h5></a>
                    </div>
                    <div class="product-info">
                        <div class="d-flex ">
                            <a href="{{ Route('index-'.$routesNames[$item->category_game]) }}" class="badge badge-default mr-1"><i class="fas fa-tag"></i> {{ $routesNames[$item->category_game] ?? '' }}</a>
                            <a href="{{ Route('search-category-'.$routesNames[$item->category_game].'-and-tag', ['category'=> $categoriesModsEn[$item->category] ]) }}" class="badge badge-default mr-1" ><i class="fas fa-tag"></i> {{ $categoryMod[$item->category]  ?? '' }}</a>
                            <a href="{{ Route('search-category-'.$routesNames[$item->category_game].'-and-tag', ['category'=> $categoriesModsEn[$item->category], 'tag'=> $item->tagEn ]) }}" class="badge badge-default mr-1" ><i class="fas fa-tag"></i> {{ $item->tagPt ?? '' }}</a>
                            <a class="badge badge-info mr-1" ><i class="fas fa-tag"></i>{{ $item->release ?? '' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
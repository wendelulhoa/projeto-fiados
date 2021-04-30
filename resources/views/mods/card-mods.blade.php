<style>
    .preview,
    .img-responsive {
        width: 100%;
        border-radius: 4px;
        max-height: 175px;
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
</style>
@foreach ($mods as $key => $item)
@php
    $image = json_decode($item->images);
@endphp
<div class="col-sm-4 col-xl-4">
    <div class="card item-card">
        <div class="card-body">
            <div class="product">
                <div class="text-center product-img">
                    <img src="{{ Route('index') . '/'. $image[0]->path }}" alt="img" class="img-fluid">
                </div>
                <div class=" text-center mt-4">
                    <div class="text-center text-warning">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <a href="#"><h5 class="mb-0 mt-2">{{$item->name}}</h5></a>
                    <div class="price mt-3 h4 mb-0">
                        <s class="h4 text-muted mr-4">$80.00</s>$59.00
                    </div>
                </div>
                <div class="product-info">
                    <a href="#" class="btn  btn-info btn-sm mt-1 mb-1 text-sm  text-white">
                        <i class="fe fe-heart"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-danger mt-1 text-sm  mb-1 text-white">
                        <i class="fe fe-share-2"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-warning mt-1 text-sm  mb-1 text-white">
                        <i class="fe fe-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="text-right text-secondary">
                    @php
                        $image = json_decode($item->images);
                    @endphp
                    <a href="{{ Route('mods-detail',['id'=>$item->id]) }}">
                       <img title="2017 Audi R8 V10 Plus [ Add-On | OIV ]" class="img-responsive"
                        alt="2017 Audi R8 V10 Plus [ Add-On | OIV ]"
                        src="{{ Route('index') . '/'. $image[0]->path }}">
                        </a> 
                    <div class="row pt-2 ml-5 pl-4 ">
                        <i class="fas fa-download fa-1x"></i>
                        <p class="pl-2 pr-2">100</p>
                        <i class="fas fa-star"></i>
                        <p class="pl-2 pr-2">5</p>
                        <i class="fas fa-thumbs-up"></i>
                        <p class="pl-2">10</p>
                    </div>
                    <div class="row ml-2 ">
                        <p class="font-weight-bold ">{{$item->name}}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="" class="badge badge-secondary"><i class="fas fa-tag"></i> CARRO</a>
                <a href="" class="badge badge-secondary"><i class="fas fa-tag"></i> CARRO</a>
                <a href="" class="badge badge-secondary"><i class="fas fa-tag"></i> CARRO</a>
                <a href="" class="badge badge-secondary"><i class="fas fa-tag"></i> CARRO</a>
                <a class="badge badge-info"> VERSÃO 1.01</a>
            </div>

        </div>
    </div>
</div> --}}
@endforeach
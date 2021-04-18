<style>
    .preview,
    .img-responsive {
        width: 100%;
        border-radius: 4px;
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

<div class="col-xl-3 col-lg-6 col-md-6 col-sm-8 p-2">
    <div class="card cartao ">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="text-right text-secondary">
                    @php
                        $image = json_decode($item->images);
                    @endphp
                    <a href="">
                    <img title="2017 Audi R8 V10 Plus [ Add-On | OIV ]" class="img-responsive"
                        alt="2017 Audi R8 V10 Plus [ Add-On | OIV ]"
                        src="{{ Route('index') . '/'. $image->path}}">
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
                        <p class="font-weight-bold ">{{ $item->name }}</p>
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
</div>
@endforeach
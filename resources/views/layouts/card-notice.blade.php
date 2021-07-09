@php
   $titleUrl = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/"),explode(" ","a A e E i I o O u U n N c "),$title);
@endphp
<div class="col-sm-12 col-xl-4">
    <div class="card">
        @if (!empty($item->image_principal))
            <a href="{{Route('post-detail', ['id'=>$item->id, 'type'=> $categories[$item->category] ?? 0, 'title'=>str_replace(" ", "-", $titleUrl)])}}"><img class="card-img-top" src="{{Route('index').'/resize/512-256-60/'.$item->image_principal}}" alt="{{$title}}"></a>
        @endif
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center pb-5 mt-auto">
                <div><img class="avatar brround avatar-md mr-3" src="{{ $item->image != null ? Route('index').'/'.'images/'.$item->image : mix('images/user.png') }}" alt="img"></div>
                <div>
                    <a href="#" class="text-default font-weight-semibold">{{$author ?? ''}}</a>
                    <small class="d-block text-muted">{{ date_format($item->created_at ,'d/m/Y') }}</small>
                </div>
                <div class="ml-auto text-muted">
                    {{-- <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                    <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-thumbs-o-up"></i></a> --}}
                </div>
            </div>
            <h4><a href="{{Route('post-detail', ['id'=>$item->id,'type'=> $categories[$item->category] ?? 0, 'title'=>str_replace(" ", "-", $titleUrl)])}}">{{$title}}</a></h4>
            {{-- <div class="text-muted">To take a trivial example, which of us ever undertakes laborious physical exerciser , except to obtain some advantage from it...</div> --}}
            <a href="{{Route('post-detail', ['id'=>$item->id, 'type'=> $categories[$item->category] ?? 0, 'title'=>str_replace(" ", "-", $titleUrl)])}}" class=" mt-3 btn btn-md btn-primary">Leia mais</a>
        </div>
    </div>
</div>
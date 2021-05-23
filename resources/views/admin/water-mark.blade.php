@extends('template.index')

@section('content')

<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Marca D'água</h3>
                </div>
            </div>
            <div class="pt-4 pl-4">
                <form action="{{ Route('water-mark') }}" method="POST" id="perfil-img"
                    enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="custom-avatar-form">
                        <div>
                            <div class="row pt-3">
                                <div class="col-2 col-md-2">
                                    <a class="thumbnail jq-thumb">
                                        <img src="{{ Route('index') . '/get/logo' }}"
                                            alt="thumb1" class="thumbimg" id="img-modify">
                                    </a>
                                </div>
                                <input type="file" name="logo" class="pt-3" id="input-avatar"
                                    accept="image/jpeg, image/png">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-js')
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('#input-avatar').change(function(){
        var files = $(this)[0].files[0];
        filesAdd.push(files)

        const fileReader = new FileReader();
        fileReader.onloadend = function(){
           $('#img-modify').attr('src', fileReader.result)
        };
        
        fileReader.readAsDataURL(files)
    })
</script>
@endsection
@extends('template.index')
@section('content')
<!--Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Edição perfil</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item py-3" data-acc-step>
                        <a href="#" class="mb-0 form-collapse-tab" data-content="1">
                            <h5 class="mb-0" data-acc-title>Informações gerais</h5>
                        </a>
                        <div class="1" data-acc-content>
                            <div class="my-3">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">Username</label>
                                                <input type="text" class="form-control" id="exampleInputname"
                                                    name="name" placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                            placeholder="email address">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="form-label">About Me</label>
                                        <textarea class="form-control" rows="6">My bio.........</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Website</label>
                                        <input class="form-control" placeholder="http://IndoUi.com">
                                    </div> --}}

                                </div>
                                <button type="submit" class="btn btn-primary float-right ml-2 mt-5">Salvar</button>

                            </div>

                        </div>

                    </div>
                    <div class="list-group-item py-3" data-acc-step>
                        <a href="#" class="mb-0 form-collapse-tab" data-content="2">
                            <h5 class="mb-0" data-acc-title>Trocar foto de perfil</h5>
                        </a>
                        <div class="2" data-acc-content>
                            <div class="my-3">
                                <form action="{{ Route('user-image-update') }}" method="POST" id="perfil-img" enctype="multipart/form-data">
                                     {{csrf_field()}}
                                    <div class="custom-avatar-form">
                                        <b for="input-avatar">Carregar uma imagem de perfil personalizada:</b>
                                        <small>(Somente .jpg ou .png; Tamanho máximo de 750Kb; Resolução recomendada de
                                            256x256 pixels)</small>
                                        <div>
                                            <div class="row pt-3">
                                                <div class="col-2 col-md-2">
                                                    <a class="thumbnail jq-thumb">
                                                        <img src="{{ auth()->user()->image != null ? Route('index').'/'.'images/'.auth()->user()->image : mix('images/user.png') }}"
                                                            alt="thumb1" class="thumbimg" id="img-modify">
                                                    </a>
                                                </div>
                                                <input type="file" name="img" class="pt-3" id="input-avatar"
                                                    accept="image/jpeg, image/png">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right ml-2 mt-5">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item py-3" data-acc-step>
                        <a href="#" class="mb-0 form-collapse-tab" data-content="3">
                            <h5 class="mb-0" data-acc-title>Alterar Senha</h5>
                        </a>
                        <div class="3" data-acc-content>
                            <div class="my-3">
                                <form action="{{ Route('user-password-update') }}" method="POST" id="form-password">
                                   {{csrf_field()}}
                                    <div class="form-group mb-0 mt-5">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Senha antiga</label>
                                                    <input type="password" class="form-control password" name="password_old">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nova senha</label>
                                                    <input type="password" class="form-control password" id="password-new" name="password">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label>Confirmar senha</label>
                                                    <input type="password" class="form-control password" id="password-verify">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right ml-2 mt-5 button-password" disabled>Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script-js')
@include('admin.admin-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.password').on('focusout', function(){
        $('.button-password').attr('disabled', true);
       if($(this).attr('id') == 'password-verify'){
           if($(this).val() == $('#password-new').val()){
               $('.button-password').attr('disabled', false);
           }else{
               alert('as senhas não correspondem')
           }
       }
    })

    $('#form-password').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ Route('user-password-update') }}",
            method:'POST',
            data: $(this).serialize(),
            success: function(data){
                $('.reset').val('');
            }
        });
    });

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
@endsection
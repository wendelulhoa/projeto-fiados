@extends('template.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">Edição perfil</h3>
        </div>
        <div class="card-options">
            <a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="true">
                <span class="fe fe-more-horizontal fs-20"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li><a href="#"><i class="fe fe-eye mr-2"></i>View</a></li>
                <li><a href="#"><i class="fe fe-plus-circle mr-2"></i>Add</a></li>
                <li><a href="#"><i class="fe fe-trash-2 mr-2"></i>Remove</a></li>
                <li><a href="#"><i class="fe fe-download-cloud mr-2"></i>Download</a></li>
                <li><a href="#"><i class="fe fe-settings mr-2"></i>More</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body p-6">
        <div class="panel panel-primary">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1 ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        {{-- <li class=""><a href="#tab5" data-toggle="tab">username e email</a></li> --}}
                        <li><a href="#tab6" data-toggle="tab" class="">Foto de perfil</a></li>
                        <li><a href="#tab7" data-toggle="tab" class="active">Senha</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    <div class="tab-pane" id="tab5">
                        <div class="my-3">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname">Username</label>
                                            <input type="text" class="form-control" id="exampleInputname" name="name"
                                                placeholder="Username" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        placeholder="email address" value="{{ Auth::user()->email }}">
                                </div>
                                <button type="submit" class="btn btn-primary float-right ml-2 mt-5">Salvar</button>

                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab6">
                        <div class="my-3">
                            <form action="{{ Route('user-image-update') }}" method="POST" id="perfil-img"
                                enctype="multipart/form-data">
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
                                                accept="image/jpeg, image/png" required>
                                        </div>
                                            <button type="submit" class="btn btn-primary float-right ">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab7">
                        <div class="my-3">
                            <form action="{{ Route('user-password-update') }}" method="POST" id="form-password">
                                {{csrf_field()}}
                                <div class="form-group mb-0 mt-5">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Senha antiga</label>
                                                <input type="password" class="form-control password reset"
                                                    name="password_old" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nova senha</label>
                                                <input type="password" class="form-control password reset"
                                                    id="password-new" name="password" required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Confirmar senha</label>
                                                <input type="password" class="form-control password reset"
                                                    id="password-verify" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right mt-1 button-password"
                                    disabled>Salvar</button>
                            </form>
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
    $('.password').on('focusout keyup', function(){
        
        if($('#password-new').val() == $('#password-verify').val()){
            $('.button-password').attr('disabled', false);
        }else{
            $('.button-password').attr('disabled', true);
        }
    })

    $('#form-password').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ Route('user-password-update') }}",
            method:'POST',
            data: $(this).serialize(),
            success: function(data){
                toastr.success("Senha alterada com sucesso.") 
                $('.reset').val('');
            },
            error: function(){
               toastr.error('Ops! verifique se as senhas então corretas e tente novamente.') 
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
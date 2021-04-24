<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ mix('/css/style-menu.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body style=" background-color: #eee;">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-xl-none d-lg-none d-md-none">
    <a class="navbar-brand" href="#">Brmods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @if(Auth::user()->type_user == 1)
      <ul class="navbar-nav mr-auto p-2">
        <li class="nav-item">
          <a href="{{ Route('admin-index') }}" class="nav-link text-white current mb-3"><i
              class="fas fa-home text-light fa-lg mr-3"></i>Inicio </a>

        </li>
        <li class="nav-item">
          <a href="{{ Route('admin-create') }}" class="nav-link text-white link mb-3"><i
              class="fas fa-address-card fa-lg mr-3"></i></i>Cadastros</a>

        </li>
        <li class="nav-item">
          <a href="{{ Route('admin-listusers') }}" class="nav-link text-white link mb-3"> <i
              class="fas fa-users fa-lg mr-3"></i></i></i>Usuarios</a>

        </li>
        <li class="nav-item">
          <a href="" class="nav-link text-white link mb-3"><i class="fas fa-money-bill-wave fa-lg mr-3"></i>Mods
            aprovados</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link text-white link"><i class="fas fa-sign-out-alt fa-lg mr-3"></i>Sair</a>

        </li>
      </ul>
    @else
      <ul class="navbar-nav mr-auto p-2">
        <li class="nav-item">
          <a href="{{ Route('admin-index') }}" class="nav-link text-white current mb-3"><i
              class="fas fa-home text-light fa-lg mr-3"></i>Inicio </a>

        </li>
        <li class="nav-item">
          <a href="{{ Route('admin-create') }}" class="nav-link text-white link mb-3"><i
              class="fas fa-address-card fa-lg mr-3"></i></i>Cadastros</a>

        </li>
        <li class="nav-item">
          <a href="{{ Route('admin-listusers') }}" class="nav-link text-white link mb-3"> <i
              class="fas fa-users fa-lg mr-3"></i></i></i>Usuarios</a>

        </li>
        <li class="nav-item">
          <a href="" class="nav-link text-white link mb-3"><i class="fas fa-money-bill-wave fa-lg mr-3"></i>Mods
            aprovados</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link text-white link"><i class="fas fa-sign-out-alt fa-lg mr-3"></i>Sair</a>

        </li>
      </ul>
    @endif
    </div>
  </nav>




  <nav class="navbar navbar-expand-md navbar-light">
    <div class="collapse navbar-collapse ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-2  col-lg-3 col-md-3  mt-lg-0 mt-md-0 mt-sm-5 mr-sm-5 menu-lateral fixed-top">
            <div class="borda-baixo mt-3 ">
              <a href="" class="text-white navbar-brand ml-4">Brmods</a>
            </div>

            <div class="borda-baixo pb-3 pt-3">
              <i class="fas fa-user text-light fa-lg mr-3"></i> <a href="" class="text-white">{{ Auth::user()->name }}</a>
            </div>
            @if (Auth::user()->type_user == 1)
              <ul class="navbar-nav flex-column mt-4 ">
                <li class="nav-item">
                  <a href="{{ Route('admin-index') }}" class="nav-link text-white current mb-3"><i
                      class="fas fa-home text-light fa-lg mr-3"></i>Inicio </a>

                </li>
                <li class="nav-item">
                  <a href="{{ Route('admin-create') }}" class="nav-link text-white link mb-3"><i
                      class="fas fa-address-card fa-lg mr-3"></i></i>Cadastros</a>

                </li>
                <li class="nav-item">
                  <a href="{{ Route('admin-listusers') }}" class="nav-link text-white link mb-3"> <i
                      class="fas fa-users fa-lg mr-3"></i></i></i>Usuarios</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link text-white link mb-3"><i class="fas fa-money-bill-wave fa-lg mr-3"></i>Mods
                    aprovados</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link text-white link"><i class="fas fa-sign-out-alt fa-lg mr-3"></i>Sair</a>
                </li>

              </ul>
            @else
              <ul class="navbar-nav flex-column mt-4 ">
                <li class="nav-item">
                  <a href="{{ Route('admin-index') }}" class="nav-link text-white current mb-3"><i
                      class="fas fa-home text-light fa-lg mr-3"></i>Inicio</a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('admin-create') }}" class="nav-link text-white link mb-3"><i
                      class="fas fa-address-card fa-lg mr-3"></i></i>Cadastro mod</a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('admin-listusers') }}" class="nav-link text-white link mb-3"> <i
                      class="fas fa-users fa-lg mr-3"></i> Favoritos</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link text-white link mb-3"><i class="fas fa-money-bill-wave fa-lg mr-3"></i>Mods
                    aprovados</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link text-white link"><i class="fas fa-sign-out-alt fa-lg mr-3"></i>Sair</a>
                </li>

              </ul>
            @endif
           

          </div>
        </div>

      </div>
    </div>
  </nav>


  @yield('content')



  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @include('admin.admin-js')
</body>

</html>
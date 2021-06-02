@extends('template.index')

@section('content')

<div class="page">

	<!-- page-content -->
	<div class="page-content">
		<div class="container text-center text-dark">
			<div class="row">
				<div class="col-lg-4 d-block mx-auto">
					<div class="row">
						<div class="col-xl-12 col-md-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="text-center mb-6">
										{{-- <img src="{{ mix('/images/logo.png') }}" class="header-brand-img main-logo" > --}}
									</div>
									<form action="{{route('register')}}" method="POST">
										{{csrf_field()}}
										<h3>Cadastrar</h3>
										<p class="text-muted">Criar nova conta</p>
										<div class="input-group mb-3">
											<span class="input-group-addon bg-white"><i class="fa fa-user w-4"></i></span>
											<input type="text" placeholder="digite seu nome" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
											@error('name') 
												<span class="invalid-feedback" role="alert">
													<strong>Esse username já existe!!</strong>
												</span>
											@enderror
										</div>
										<div class="input-group mb-3">
											<span class="input-group-addon bg-white"><i class="fa fa-user"></i></span>
											<input type="email" placeholder="digite o email." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>Esse email já existe!!</strong>
												</span>
											@enderror
										</div>
										<div class="input-group mb-4">
											<span class="input-group-addon bg-white"><i class="fa fa-unlock-alt"></i></span>
											<input type="password" class="form-control" name="password" placeholder="digite a senha." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
										</div>
										<div class="input-group mb-4">
											<span class="input-group-addon bg-white"><i class="fa fa-unlock-alt"></i></span>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirme sua senha." required autocomplete="new-password">    												</div>
										<div class="form-group">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" />
												<span class="custom-control-label">Aceitar os <a href="terms.html">termos de uso</a></span>
											</label>
										</div>
										<div class="row">
											<div class="col-12">
												<button type="submit" class="btn btn-primary btn-block px-4">Criar conta</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- page-content end -->

</div>
@endsection

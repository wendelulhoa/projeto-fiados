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
											<form method="POST" action="{{ route('login') }}">
												{{csrf_field()}}
												<h3>Login</h3>
												<p class="text-muted">Entre com sua conta</p>
												<div class="input-group mb-3">
													<span class="input-group-addon bg-white"><i class="fa fa-user"></i></span>
													<input id="email" placeholder="Digite seu email..." type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>Verifique o email ou senha se estão corretos!</strong>
                                                        </span>
                                                     @enderror
                                                </div>
												
                                                <div class="input-group mb-4">
													<span class="input-group-addon bg-white"><i class="fa fa-unlock-alt"></i></span>
													<input id="password" type="password" placeholder="Digite sua senha..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
												</div>
                                                <div class="form-group">
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
														<span class="custom-control-label">lembrar?</span>
													</label>
												</div>
												<div class="row">
													<div class="col-12">
														<button type="submit" class="btn btn-primary btn-block">Entrar</button>
													</div>
													<div class="col-12">
														{{-- <a href="{{ Route('register') }}" class="btn btn-link box-shadow-0 px-0">deseja se cadastrar?</a> --}}
                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link box-shadow-0 px-0" href="{{ route('password.request') }}">
                                                                {{ __('Esqueceu a senha?') }}
                                                            </a>
                                                        @endif
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

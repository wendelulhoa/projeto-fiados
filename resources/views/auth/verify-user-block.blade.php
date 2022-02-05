@extends('template.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('conta bloqueada.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Email enviado com sucesso.') }}
                        </div>
                    @endif

                    {{ __('Sua conta foi temporariamente bloqueada.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

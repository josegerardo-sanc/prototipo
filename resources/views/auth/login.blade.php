@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
             <div class="card">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="card-body">
                    <div class="form-row justify-content-center align-items-center">
                           <div class="col-sm-2">
                             <img src="{{asset('recursos_default/logo.jpg')}}" class="thumbnail" alt="logo" width="80px;" height="80px;">
                           </div>
                           <div class="col"><h1 class="display-4 text-left">Iniciar session</h1></div>
                        </div>
                    <hr>
                        <div class="form-group row">
                            <label for="email" class="col-sm-6 col-form-label text-bold"><strong>Correo electronico</strong></label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                  </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-6 col-form-label text-bold"><strong>Contraseña</strong></label>
                            <a href="#" class="col-sm-6 col-form-label text-right">He olvidado mi contraseña</a>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        <strong>{{ __('recordar cuenta') }}</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group row justify-content-end">
                                <div class="col-sm-6">
                                    <a href="#" class="btn-block btn btn-light text-primary">
                                        <i class="fab fa-facebook mr-2"></i>Facebook
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="btn-block btn btn-light text-danger">
                                    <i class="fab fa-google-plus mr-2"></i>Google+
                                    </a>
                                </div>
                          </div> --}}
                          <div class="form-group row justify-content-end">
                             <div class="col-sm-6 text-right">
                                <label for="" class="col-form-label"><strong>No tengo cuenta</strong>
                                  <a href="{{url('error')}}" class="btn btn-link">Crear una</a>
                                </label>
                             </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn-block btn btn-primary" style="border-radius:0px;">Iniciar session</button>
                            {{-- <button type="button" class="btn btn-danger" style="border-radius:0px;">Cancelar</button> --}}
                        </div>
                    </div>
                </div>
            </form>
            </div> 
            {{-- fin del card --}}
        </div>
    </div>
</div>
@endsection

@extends('Principal.Body')

@section('contenido')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nuevo usuario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Lista De Usuarios</a></li>
            <li class="breadcrumb-item active">Nuevo Usuario</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('status'))
                    <div class="alert  alert-dismissible fade show" style="background-color: #B7E7C6;" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                @endif
            </div>
          <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                   
                <form method="POST" action="{{url(isset($user_edit)?'/allUser/'.$user_edit[0]->id_user:'/allUser')}}">
                        @if (isset($user_edit))
                            @method('PUT')
                            <input type="hidden" name="id_user" value="{{$user_edit[0]->id}}">
                        @endif
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="area">Àrea</label>
                                <select class="custom-select" id="area" required name="area" required autocomplete="area">
                                   <option selected disabled value="">Eliga una opcion</option>
                                    @if (isset($areas))
                                        @foreach ($areas as $item) 
                                            <option 
                                            @isset($user_edit)
                                                @if ($user_edit[0]->id_area==$item->id)
                                                    selected
                                                @endif
                                            @endisset  
                                            value="{{$item->id}}">{{$item->area_new}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="name" class="col-sm-12 col-form-label">{{ __('Nombre') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user_edit)?$user_edit[0]->nombre:old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                           </div>
                           <div class="col-sm-4">
                                 <label for="name" class="col-sm-12 col-form-label">{{ __('Paterno') }}</label>
                                  <div class="col-md-12">
                                    <input id="paterno" type="text" class="form-control @error('paterno') is-invalid @enderror" name="paterno" value="{{ isset($user_edit)?$user_edit[0]->paterno:old('paterno') }}" required autocomplete="paterno" autofocus>
                                    @error('paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                           </div>
                            <div class="col-sm-4">
                                    <label for="name" class="col-sm-12 col-form-label">{{ __('Materno') }}</label>
                                    <div class="col-md-12">
                                        <input id="materno" type="text" class="form-control @error('materno') is-invalid @enderror" name="materno" value="{{ isset($user_edit)?$user_edit[0]->materno:old('materno') }}" required autocomplete="materno" autofocus>
                                        @error('materno')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="email" class="col-sm-12 col-form-label">{{ __('Correo') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{isset($user_edit)?$user_edit[0]->email: old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="col-sm-12 col-form-label">{{ __('Telefono') }}</label>
                                <div class="col-md-12">
                                    <input minlength="10" maxlength="15"  id="telefono" type="text" class="validarCampo form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ isset($user_edit)?$user_edit[0]->telefono:old('telefono') }}" required autocomplete="telefono">

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label for="exampleFormControlTextarea1">Direccion</label>

                            <textarea id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror"  required autocomplete="direccion" rows="3">{{ isset($user_edit)?$user_edit[0]->direccion:old('direccion') }}</textarea>
                               @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="text-white btn btn-{{isset($user_edit)?'warning':'primary'}} btn-block">
                                    {{isset($user_edit)?'Actualizar Usuario':'Registrar usuario'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $('.validarCampo').keypress(function(e) {
        var key = window.Event ? e.which : e.keyCode;
        var patron=/^[0-9\s]+$/;
        var tecla_final=String.fromCharCode(key);
        console.log(tecla_final);
        return patron.test(tecla_final);
     });
    </script>
@endsection

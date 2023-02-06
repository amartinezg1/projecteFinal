@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <!--Error message or success message-->
      @if (Session::has('error'))
        <div class="alert alert-danger align-items-center" role="alert">{{Session::get('error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card">
        <div class="card-header">{{ __('Perfil cliente') }}</div>
        <div class="card-body">
          <form method="POST" action="clientProfile">
            {{ csrf_field() }}
            <!--Dni client-->
            <div class="form-row mt-2">
              <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="form-group">
                  <label>DNI cliente</label>
                  <input id="dniClient" type="text" name="dniClient" value="{{ old('dniClient') }}" required autofocus>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-12 align-self-center">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Search') }}
                  </button>
                </div>
              </div>
            </div>
          </form>
          @if(isset($client))
          <form method="POST" action="updateClient">
            {{ csrf_field() }}
              <div class="form-row mt-2">
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <input type="hidden" id="client_id" name="client_id" value="{{$client[0]->client_id}}">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$client[0]->name}}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>1er Apellido</label>
                    <input id="surname1" type="text" class="form-control{{ $errors->has('surname1') ? ' is-invalid' : '' }}" name="surname1" value="{{ $client[0]->surname1 }}" required autofocus>
                    @if ($errors->has('surname1'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname1') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label>2nd Apellido</label>
                    <input id="surname2" type="text" class="form-control{{ $errors->has('surname2') ? ' is-invalid' : '' }}" name="surname2" value="{{ $client[0]->surname2 }}" required autofocus>
                    @if ($errors->has('surname2'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname2') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
              </div>

              <!--DNI i email-->
              <div class="form-row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>DNI</label>
                    <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ $client[0]->dni }}" required autofocus>
                    @if ($errors->has('dni'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $client[0]->email }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
              </div>
              <!--Dirrecció i codi postal-->
              <div class="form-row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Dirección</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{ $client[0]->address }}">
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Codigo Postal</label>
                    <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ $client[0]->zip_code }}">
                  </div>
                </div>
              </div>

              <!--Telefons-->
              <div class="form-row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Teléfono1</label>
                    <input id="phone1" type="text" class="form-control" name="phone1" value="{{ $client[0]->phone1 }}">
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Teléfono2</label>
                    <input id="phone2" type="text" class="form-control" name="phone2" value="{{ $client[0]->phone2 }}">
                  </div>
                </div>
              </div>

              <!--Passwords-->
              <div class="form-row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label for="password-confirm">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password-confirm">
                  </div>
                </div>
              </div>
              <div class="form-row">
                  <div class="col-6 offset-6">
                    <div class="form-group float-right">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Save') }}
                      </button>
                    </div>
                  </div>
              </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

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
        <div class="card-header">
          <h4>{{ __('language.profile') }}</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="updateUser">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="name">{{ __('language.name') }}</label>
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="surname1">{{ __('language.surname1') }}</label>

                    <input id="surname1" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname1" value="{{$user->surname1}}" required autofocus>

                    @if ($errors->has('surname1'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname1') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="surname2">{{ __('language.surname2') }}</label>
                    <input id="surname2" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname2" value="{{$user->surname2}}" required autofocus>

                    @if ($errors->has('surname2'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname2') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
            </div>
            <!--Cognom2 i dni-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="dni">{{ __('DNI') }}</label>
                    <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{$user->dni}}" required autofocus>

                    @if ($errors->has('dni'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="user_role">{{ __('language.role') }}</label>
                  @if(Auth::user()->user_role == "admin")
                  <select class="form-control" name="user_role" id="user_role">
                    <option value="admin" selected>Admin</option>
                    <option value="receptionist">Recepcionista</option>
                    <option value="vet">Veterinario</option>
                    <option value="aux">Auxiliar</option>
                  </select>
                  @else
                    <input id="user_role" name="user_role" class="form-control" value="{{$user->user_role}}"readonly>
                  @endif
                </div>
              </div>
            </div>
            <!--EMails-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="email">{{ __('E-Mail') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="email_confirm">{{ __('language.confirmEmail') }}</label>
                    <input id="email_confirm" type="text" class="form-control" name="email_confirm" >
                </div>
              </div>
            </div>
            <!--Password-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="password-confirm">{{ __('language.confirmPassword') }}</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                </div>
              </div>
            </div>
            <!--Direcció-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="address">{{ __('language.address') }}</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{$user->address}}" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="zip_code">{{ __('language.zipCode') }}</label>
                    <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{$user->zip_code}}" required>
                </div>
              </div>
            </div>
            <!--Teléfons-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="phone1">{{ __('language.phone1') }}</label>
                    <input id="phone1" type="text" class="form-control" name="phone1" value="{{$user->phone1}}" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="phone2">{{ __('language.phone2') }}</label>
                    <input id="phone2" type="text" class="form-control" name="phone2" value="{{$user->phone2}}">
                </div>
              </div>
            </div>


            <div class="form-row">

            </div>
            <div class="form-row">
              <div class="col-md-6 offset-md-6">
                <div class="form-group float-right">
                  <button type="submit" class="btn btn-primary">
                    {{ __('language.save') }}
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

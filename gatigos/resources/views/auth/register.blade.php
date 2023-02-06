@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="card">
        <div class="card-header">
          <h4>{{ __('language.register') }}</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" >
            @csrf
            <div class="form-row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="name">*{{ __('language.name') }}</label>
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="surname1">*{{ __('language.surname1') }}</label>

                    <input id="surname1" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname1" value="{{ old('surname1') }}" required autofocus>

                    @if ($errors->has('surname1'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname1') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="surname2">*{{ __('language.surname2') }}</label>
                    <input id="surname2" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname2" value="{{ old('surname2') }}" required autofocus>

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
                    <label for="dni">*{{ __('DNI') }}</label>
                    <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required autofocus>

                    @if ($errors->has('dni'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="user_role">*{{ __('language.role') }}</label>
                  <select class="form-control" name="user_role" id="user_role" required>
                    <option value="" hidden selected disabled>{{ __('language.employeeRole') }}</option>
                    <option value="admin">{{ __('language.admin') }}</option>
                    <option value="receptionist">{{ __('language.receptionist') }}</option>
                    <option value="vet">{{ __('language.vet')}}</option>
                  </select>
                </div>
              </div>
            </div>
            <!--EMails-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="email">*{{ __('language.emailAddress') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="email_confirm">*{{ __('language.confirmEmail') }}</label>
                    <input id="email_confirm" type="text" class="form-control" name="email_confirm" required>
                </div>
              </div>
            </div>
            <!--Password-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="password">*{{ __('language.password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="password-confirm">*{{ __('language.confirmPassword') }}</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <!--Direcció-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="address">*{{ __('language.address') }}</label>
                    <input id="address" type="text" class="form-control" name="address" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="zip_code">*{{ __('language.zipCode') }}</label>
                    <input id="zip_code" type="text" class="form-control" name="zip_code" required>
                </div>
              </div>
            </div>
            <!--Teléfons-->
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="phone1">*{{ __('language.phone1') }}</label>
                    <input id="phone1" type="text" class="form-control" name="phone1" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="phone2">{{ __('language.phone2') }}</label>
                    <input id="phone2" type="text" class="form-control" name="phone2">
                </div>
              </div>
            </div>


            <div class="form-row">

            </div>
            <div class="form-row">
              <div class="col-md-6 offset-md-6">
                <div class="form-group float-right">
                  <button type="submit" class="btn btn-primary">
                    {{ __('language.saveRegister') }}
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

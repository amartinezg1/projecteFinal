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
        <div class="card-body">
          <ul class="nav nav-tabs col-12" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#altaDueño">{{ __('language.signUpOwner')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#altaMascota">{{ __('language.signUpPet')}}</a>
            </li>
          </ul>

          <div class="tab-content">
            <div id="altaDueño" class="row tab-pane active mt-3 ml-2 mr-2">
              <form method="POST" action="/ownerRegister">
                {{ csrf_field() }}
                  <div class="form-row mt-2">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>*{{ __('language.name')}}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>*{{ __('language.surname1')}}</label>
                        <input id="surname1" type="text" class="form-control{{ $errors->has('surname1') ? ' is-invalid' : '' }}" name="surname1" value="{{ old('surname1') }}" required autofocus>
                        @if ($errors->has('surname1'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('surname1') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>*{{ __('language.surname2')}}</label>
                        <input id="surname2" type="text" class="form-control{{ $errors->has('surname2') ? ' is-invalid' : '' }}" name="surname2" value="{{ old('surname2') }}" required autofocus>
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
                        <label>*DNI</label>
                        <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required autofocus>
                        @if ($errors->has('dni'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dni') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
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
                  </div>
                  <!--Dirrecció i codi postal-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>*{{ __('language.address')}}</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>*{{ __('language.zipCode')}}</label>
                        <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required>
                      </div>
                    </div>
                  </div>

                  <!--Telefons-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>*{{ __('language.phone1')}}</label>
                        <input id="phone1" type="text" class="form-control" name="phone1" value="{{ old('phone1') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>{{ __('language.phone2')}}</label>
                        <input id="phone2" type="text" class="form-control" name="phone2" value="{{ old('phone2') }}">
                      </div>
                    </div>
                  </div>

                  <!--Passwords-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="password">*{{ __('language.password')}}</label>
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="password-confirm">*{{ __('language.confirmPassword')}}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password-confirm" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                      <div class="col-6 offset-6">
                        <div class="form-group float-right">
                          <button type="submit" class="btn btn-primary">
                              {{ __('language.save') }}
                          </button>
                        </div>
                      </div>
                  </div>
              </form>
            </div>

            <!--Alta Mascota-->
            <div id="altaMascota" class="row tab-pane fade mt-3 ml-2 mr-2">
              <form method="POST" action="petRegister">
                {{ csrf_field() }}
                <!--Nom, dni propietari i chip-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>*{{ __('language.petName')}}</label>
                        <input id="petName" type="text" class="form-control{{ $errors->has('petName') ? ' is-invalid' : '' }}" name="petName" value="{{ old('petName') }}" required autofocus>
                        @if ($errors->has('petName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('petName') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>Chip</label>
                        <input id="chip_id" type="text" class="form-control" name="chip_id" value="{{ old('chip_id') }}" >
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label>*{{ __('language.dniOwner')}}</label>
                        <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required autofocus>
                        @if ($errors->has('dni'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dni') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <!--Especie i raça-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>*{{ __('language.specie')}}</label>
                        <input id="specie" type="text" class="form-control{{ $errors->has('specie') ? ' is-invalid' : '' }}" name="specie" value="{{ old('specie') }}" required autofocus>
                        @if ($errors->has('specie'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('specie') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for="breed">*{{ __('language.breed') }}</label>
                        <input id="breed" type="text" class="form-control{{ $errors->has('breed') ? ' is-invalid' : '' }}" name="breed" value="{{ old('breed') }}" required>
                        @if ($errors->has('breed'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('breed') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <!--Data naixement i pes-->
                  <div class="form-row">
                    <div class="col-sm-12 col-md-auto col-lg-auto">
                      <div class="form-group">
                        <label>*{{ __('language.day')}}</label>
                        <input id="birth_date" type="text" class="form-control datepicker" name="birth_date" placeholder="Select Date MM/DD/YYYY" readonly required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label>*{{ __('language.weight')}}</label>
                        <input id="weight" type="text" class="form-control" name="weight" value="{{ old('weight') }}" required>
                      </div>
                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            $('.datepicker').datepicker({
                                dateFormat: "dd-mm-yy",
                                showOtherMonths: true,
                                selectOtherMonths: true,
                                autoclose: true,
                                changeMonth: true,
                                changeYear: true,
                                keyboardNavigation: true,
                                orientation: "auto"
                            });
                        });
                    </script>
                  </div>
                  <div class="form-row">
                      <div class="col-6 offset-6">
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
  </div>
</div>

@endsection

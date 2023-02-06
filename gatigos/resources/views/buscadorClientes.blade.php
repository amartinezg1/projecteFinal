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

        	       <form type="hidden" id="formHistory" method="POST" action="historialOnly">
                    {{ csrf_field() }}
                  	<input type="hidden" id="sendIdPet" name="petIdinput">

                  </form>
          <h3>{{ __('language.history')}}</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="buscadorClientes">
            {{ csrf_field() }}
            <!--Nom, dni propietari i chip-->
            <div class="form-row mb-2 mt-2">
              <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="form-group">
                  <label>{{ __('language.dniOwner')}}</label>
                  <input id="dni" type="text" name="dni" value="{{ old('dni') }}" required autofocus>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-12 align-self-center">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                      {{ __('language.search') }}
                  </button>
                </div>
              </div>
            </div>
          </form>
        @if(isset($client))
        <div class="row">
	        <div class="col-auto">
		        {{$client->name}}
	        </div>
	         <div class="col-auto">
		         {{$client->surname1}}
	        </div>
	         <div class="col-auto">
		        {{$client->dni}}
	        </div>
	        <div class="col-auto ml-auto">
	        	<button class="btn btn-primary p-2" data-toggle="modal" data-target="#perfilModal">{{ __('language.modify')}} </button>
	        </div>
        </div>
        @endif
        @if(isset($petsInfo))
        	<table class="table table-hover mt-3">
        	<thead>
        	<tr>
        		<th>
        			{{ __('language.identifier')}}
        		</th>
        		<th>
        			{{ __('language.name')}}
        		</th>
        		<th>
        			{{ __('language.specie')}}
        		</th>
        		<th>
        			{{ __('language.birth_date')}}
        		</th>
        	</tr>
        	</thead>
        	<tbody>
        		@foreach ($petsInfo as $pet)
        		<tr petId="{{$pet->pet_id}}" class="mascota">
	        		<td>
						{{$pet->pet_id}}
	        		</td>
        			<td>
        				{{$pet->name}}
        			</td>
        			<td>
        				{{$pet->specie}}
        			</td>
        			<td>
        				{{explode(' ',$pet->bird_date)[0]}}
        			</td>
        		</tr>
                  @endforeach
                  </tbody>
        	</table>










         <!--Modal Perfil Cliente-->
          <div id="perfilModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalPerfilCliente">{{ __('language.ownerProfile')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
					          <form method="POST" action="updateClient">
                    {{ csrf_field() }}
                      <div class="form-row mt-2">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                          <input type="hidden" id="client_id" name="client_id" value="{{$client->client_id}}">
                          <div class="form-group">
                            <label>*{{ __('language.name')}}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$client->name}}" required autofocus>
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
                            <input id="surname1" type="text" class="form-control{{ $errors->has('surname1') ? ' is-invalid' : '' }}" name="surname1" value="{{ $client->surname1 }}" required autofocus>
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
                            <input id="surname2" type="text" class="form-control{{ $errors->has('surname2') ? ' is-invalid' : '' }}" name="surname2" value="{{ $client->surname2 }}" required autofocus>
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
                            <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ $client->dni }}" required autofocus>
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
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $client->email }}" required autofocus>
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
                            <input id="address" type="text" class="form-control" name="address" value="{{ $client->address }}" required>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>*{{ __('language.zipCode')}}</label>
                            <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ $client->zip_code }}" required>
                          </div>
                        </div>
                      </div>

                      <!--Telefons-->
                      <div class="form-row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>*{{ __('language.phone1')}}</label>
                            <input id="phone1" type="text" class="form-control" name="phone1" value="{{ $client->phone1 }}" required>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>{{ __('language.phone2')}}</label>
                            <input id="phone2" type="text" class="form-control" name="phone2" value="{{ $client->phone2 }}">
                          </div>
                        </div>
                      </div>

                      <!--Passwords-->
                      <div class="form-row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label for="password">{{ __('language.password')}}</label>
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
                            <label for="password-confirm">{{ __('language.confirmPassword')}}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password-confirm">
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
              </div>




         @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/tablaMascotas.js') }}" defer></script>
@endsection

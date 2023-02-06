@extends('layouts.app')

@section('content')
<div class="col-12 container">
  <div class="row justify-content-center">
    <div class="col-12">
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
        <h2 class="mb-5 text-center ">{{ __('language.roleManager')}}</h2>
        <table class="col-auto table">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>{{ __('language.name') }}</th>
              <th>{{ __('language.surname1') }}</th>
              <th>{{ __('language.surname2') }}</th>
              <th>{{ __('Dni') }}</th>
              <th>{{ __('language.emailAddress') }}</th>
              <th>{{ __('language.address') }}</th>
              <th>{{ __('language.zipCode') }}</th>
              <th>{{ __('language.phone1') }}</th>
              <th>{{ __('language.phone2') }}</th>
              <th>{{ __('language.active') }}</th>
              <th colspan="2">{{ __('language.role') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td class="align-middle">{{$user->user_id}}</td>
              <td class="align-middle">{{$user->name}}</td>
              <td class="align-middle">{{$user->surname1}}</td>
              <td class="align-middle">{{$user->surname2}}</td>
              <td class="align-middle">{{$user->dni}}</td>
              <td class="align-middle">{{$user->email}}</td>
              <td class="align-middle">{{$user->address}}</td>
              <td class="align-middle">{{$user->zip_code}}</td>
              <td class="align-middle">{{$user->phone1}}</td>
              <td class="align-middle">{{$user->phone2}}</td>
              <!--ACTIVO-->
              @if ($user->active==1)
                <td class="align-middle">True</td>
              @else
              <td class="align-middle">False</td>
              @endif
              <!--ROLES-->
              <td>
                  {{$user->user_role}}
              </td>
              <td>
                <button class="abrirModal btn btn-primary btn-sm"
                userid="{{$user->user_id}}"
                username="{{$user->name}}"
                surname1="{{$user->surname1}}"
                surname2="{{$user->surname2}}"
                dni="{{$user->dni}}"
                email="{{$user->email}}"
                address="{{$user->address}}"
                zipcode="{{$user->zip_code}}"
                phone1="{{$user->phone1}}"
                phone2="{{$user->phone2}}"
                active="{{$user->active}}"
                role="{{$user->user_role}}"
                title="Editar trabajador"
                data-toggle="modal"
                data-target="#modalUsuarios">
                  <i class="fa fa-pencil " aria-hidden="true"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

<script>
$(document).ready(function(){
    $('.abrirModal').on("click",function() {
      var id = $(this).attr("userid");
      var username=$(this).attr("username");
      var surname1=$(this).attr("surname1");
      var surname2=$(this).attr("surname2");
      var dni=$(this).attr("dni");
      var email=$(this).attr("email");
      var address=$(this).attr("address");
      var zipcode=$(this).attr("zipcode");
      var phone1=$(this).attr("phone1");
      var phone2=$(this).attr("phone2");
      var active=$(this).attr("active");
      var role=$(this).attr("role");

      $('#user_id').val(id);
      $("#name").val(username);
      $("#surname1").val(surname1);
      $("#surname2").val(surname2);
      $("#dni").val(dni);
      $("#email").val(email);
      $("#address").val(address);
      $("#zip_code").val(zipcode);
      $("#phone1").val(phone1);
      $("#phone2").val(phone2);
      $('#active').val(active);
      $("#roles").val(role);
    });
});
</script>




    <!--MODAL MODIFICAR USUARIOS-->
    <div class="modal" id="modalUsuarios">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ __('language.ownerProfile') }}</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="POST" action="updateUsersWork">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <input id="user_id" name="user_id" type="hidden" name="user_id">
                    <label for="name">{{ __('language.name') }}</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>
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

                      <input id="surname1" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname1" required autofocus>

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
                      <input id="surname2" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname2" required autofocus>

                      @if ($errors->has('surname2'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('surname2') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
              </div>
              <!--EMail i Dni-->
              <div class="form-row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="dni">{{ __('Dni') }}</label>
                      <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" maxlength="9" required autofocus>

                      @if ($errors->has('dni'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('dni') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="email">{{ __('language.emailAddress') }}</label>
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

                      @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
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
                      <input id="zip_code" type="text" class="form-control" name="zip_code" maxlength="5" required>
                  </div>
                </div>
              </div>
              <!--Teléfons-->
              <div class="form-row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="phone1">{{ __('language.phone1') }}</label>
                      <input id="phone1" type="text" class="form-control" name="phone1" maxlength="9" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                      <label for="phone2">{{ __('language.phone2') }}</label>
                      <input id="phone2" type="text" class="form-control" name="phone2" maxlength="9">
                  </div>
                </div>
              </div>
              <!--Active-->
              <hr>
              <div class="form-row">
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                      <label for="active">{{ __('language.active') }}</label>
                      <select id="active" class="form-control  form-control-sm" name="active" value="{{$user->active}}" request>
                        <option value="1">True</option>
                        <option value="0">False</option>
                      </select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                      <label for="roles">{{ __('language.role') }}</label>
                      <select id="roles" class="form-control form-control-sm" name="user_role" value="{{$user->user_role}}" request>
                        <option value="admin">Admin</option>
                        <option value="receptionist">Recepcionista</option>
                        <option value="vet">Veterinario</option>
                      </select>
                  </div>
                </div>
              </div>
            <!--</form>-->
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('language.save') }}</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('language.close') }}</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

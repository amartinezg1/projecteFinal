@extends('layouts.app')
<script>
    function comprobarPeso() {
      var regex = /^(0|[1-9]\d*)(.\d+)?$/;
      var peso = $('#weight').val();
      if(regex.test(peso)) {
          return true;
      } else {
          $('#weight').addClass( "border border-danger" ).focus();
          return false;
      }
    }
</script>
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
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
          <h3>{{ __('language.history')}}</h3>
        </div>
                    {{ csrf_field() }}
        <div class="card-body">

        @if(isset($petData))
          <div class="table-responsive mt-3">

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">{{ __('language.ownerName')}}</th>
                  <th scope="col">{{ __('language.name')}}</th>
                  <th scope="col">{{ __('language.specie')}}</th>
                  <th scope="col">{{ __('language.breed')}}</th>
                  <th scope="col">{{ __('language.weight')}}</th>
                  <th scope="col">{{ __('language.birth_date')}}</th>
                  <th scope="col">Chip</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$clientName[0]->name}}  {{$clientName[0]->surname1}}</td>
                  <td>{{$petData[0]->name}}</td>
                  <td>{{$petData[0]->specie}}</td>
                  <td>{{$petData[0]->breed}}</td>
                  <td>{{$petData[0]->weight}}</td>
                  <td>{{$petData[0]->bird_date}}</td>
                  <td>{{$petData[0]->chip_id}}</td>
                  <td><button class="btn btn-primary btn-sm" title="{{ __('language.modifyPet')}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil " aria-hidden="true"></i></button></td>
                  <!--<td><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></td>-->


                  @if (Auth::user()->user_role == "vet")
                  <td><button class="btn btn-success btn-sm" title="{{ __('language.addInquiry')}}" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                  @endif
                </tr>
              </tbody>
            </table>
          </div>

          @if(isset($inquiry))
          <!--Accordion section-->
          <div id="accordion">
            @foreach($inquiry as $item)
            <div class="card">
              <button class="btn btn-link card-header collapsed" id="headingOne" data-toggle="collapse" data-target="#collapse{{$item->inquiry_id}}" aria-expanded="false" aria-controls="collapseOne">
                <div class="row">
                  <div class="col-6 text-left">{{$item->title}}</div>
                  <div class="col-6 text-right">{{$item->inquiry_date}}</div>
                </div>
              </button>

              <div id="collapse{{$item->inquiry_id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border p-2">
                      <h4>{{ __('language.diagnostic')}}</h4>
                      <div class="row">
	                      <div class="col-12">
	                      	<p>
                      			{{$item->diagnostic}}
                      		</p>
	                      </div>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 border p-2">
                    <h4>{{ __('language.observations')}}</h4>
                      <div class="row">
	                      <div class="col-12">
	                      	<p>
                      			{{$item->observations}}
                      		</p>
	                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 border p-2">
                    <h4>{{ __('language.treatment')}}</h4>
                      <div class="row">
	                      <div class="col-12">
	                      	<p>
                      			{{$item->treatment}}
                      		</p>
	                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!--Modal editar-->
          <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('language.modifyPet')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="updatePet" onsubmit="return comprobarPeso()">
                    {{ csrf_field() }}
                    <input type="hidden" id="pet_id" name="pet_id" value="{{$petData[0]->pet_id}}">
                    <div class="form-row">
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">*{{ __('language.name')}}</label>
                          <input type="text" class="form-control" id="petName" name="petName" value="{{$petData[0]->name}}" required>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Chip</label>
                          <input type="text" class="form-control" id="chip_id" name="chip_id" value="{{$petData[0]->chip_id}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">*{{ __('language.specie')}}</label>
                          <input type="text" class="form-control" id="specie" name="specie" value="{{$petData[0]->specie}}" required>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">*{{ __('language.breed')}}</label>
                          <input type="text" class="form-control" id="breed" name="breed" value="{{$petData[0]->breed}}" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">*{{ __('language.weight')}}</label>
                          <input type="text" class="form-control" id="weight" name="weight" value="{{$petData[0]->weight}}" required>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">*{{ __('language.birth_date')}}</label>
                          <input data-provide="datepicker" type="text" class="form-control" id="birth_date" name="birth_date" value="{{$petData[0]->bird_date}}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-6 offset-6">
                        <div class="form-group float-right">
                          <button type="submit" class="btn btn-primary">{{ __('language.save')}}</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('language.close')}}</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--Modal añadir-->
          <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('language.addInquiry')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="addInquiry">
                    {{ csrf_field() }}
                    <input type="hidden" id="pet_id" name="pet_id" value="{{$petData[0]->pet_id}}">
                    <div class="form-row">
                      <div class="form-group">
                        <label for="title" class="col-form-label">**{{ __('language.title')}}</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-12">
                        <label for="diagnostic" class="col-form-label">**{{ __('language.diagnostic')}}</label>
                        <textarea class="form-control" name="diagnostic" id="diagnostic" required></textarea>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-12">
                        <label for="observations" class="col-form-label">{{ __('language.observations')}}</label>
                        <textarea class="form-control" name="observations" id="observations"></textarea>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-12">
                        <label for="treatment" class="col-form-label">{{ __('language.treatment')}}</label>
                        <textarea class="form-control" name="treatment" id="treatment"></textarea>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-6 offset-6">
                        <div class="form-group float-right">
                          <button type="submit" class="btn btn-primary">{{ __('language.save')}}</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('language.close')}}</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

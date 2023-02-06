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
          <h3>{{ __('language.nextInquiry')}} </h3>
        </div>
        <div class="card-body">
        @if(isset($userVet))
        <div class="row">
	        <div class="col-auto">
		        {{$userVet->name}}
	        </div>
	         <div class="col-auto">
		       	{{$userVet->surname1}}
	        </div>
	         <div class="col-auto">
		     	{{$userVet->dni}}
	        </div>
	        <div class="col-auto">
		     	{{$userVet->email}}
	        </div>
        </div>
        @endif





























              @if(isset($datesInfo))
        	<table class="table table-hover mt-3">
        	<thead>
        	<tr>
        		<th>
        			Fecha inicio
        		</th>
        		<th>
        			Fecha Fin
        		</th>
        		 <th>
        			Consulta
        		</th>
        		<th>
        			Contacto cliente
        		</th>
        		<th>
        			Descripción
        		</th>
        	</tr>
        	</thead>
        	<tbody>
        		@foreach ($datesInfo as $date)
        		<tr dateId="{{$date->Id}}" class="date">
	        		<td>
						{{$date->StartTime}}
	        		</td>
        			<td>
        				{{$date->EndTime}}
        			</td>
        			<td>
        				{{$date->Location}}
        			</td>
        			<td>
        				{{$date->Subject}}
        			</td>
        			<td>
        				{{$date->Description}}
        			</td>
        		</tr>
                  @endforeach
                  </tbody>
        	</table>
         @endif










        <!--
        @if(isset($petsInfo))
        	<table class="table table-hover mt-3">
        	<thead>
        	<tr>
        		<th>
        			Identificador
        		</th>
        		<th>
        			Nombre
        		</th>
        		<th>
        			Especie
        		</th>
        		<th>
        			Fecha nacimiento
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
        				{{$pet->bird_date}}
        			</td>
        		</tr>
                  @endforeach
                  </tbody>
        	</table>
         @endif
          -->
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/tablaMascotas.js') }}" defer></script>
@endsection

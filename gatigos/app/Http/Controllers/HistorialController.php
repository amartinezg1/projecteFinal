<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Consultas;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public $petId;
    // si no inicias sesion te redirige al inicio
    public function __construct()
    {
      $this->middleware('auth');
    }

	// Devuelve la lista de mascotas de 1 cliente.
	public function searchAllClientPets(Request $request) {
		try {
			$clientDni = $request->input('dni');
			$clientId = DB::select(DB::raw("select client_id from clients where dni = '$clientDni'"));
			if(isset($clientId[0])) {
				$clientId = $clientId[0]->client_id;
				$petsInfo = DB::select(DB::raw("select * from pets where owner = '$clientId'"));
				$client = $this->clientProfile($request, $clientDni);
			} else {
				throw new Exception("Value must be 1 or below");
			}
		} catch(Exception $exception) {
        return redirect()->back()->with('error','Cliente no encontrado.');
		}
		return view('buscadorClientes')->with('petsInfo', $petsInfo)->with('client', $client[0]);
	}

    public function clientProfile(Request $request, String $dni){
      try {
        // Save client data in a variable
        $client = DB::select(DB::raw("select * from clients where dni = '$dni'"));;
        // Other way
        //$user = auth()->user();
      } catch(Exception $exception){
        return redirect()->back()->with('error','Cliente no encontrado.');
      }
      return $client;
    }

    // Devuelve información e historiales de 1 mascota.
    public function searchFullDataPet(Request $request){
        try {
          $petId = $_GET['petIdinput'];
        } catch (Exception $e) {
          $petId = $request->input('petIdinput');
        }
      try {
        //$petId = $request->input('petIdinput');

        $petData = DB::select(DB::raw("select * from pets where pet_id = '$petId'"));
        $nuevaFecha =  $petData[0]->bird_date;
        $nuevaFecha = explode(' ', $nuevaFecha);
        $nuevaFecha = $nuevaFecha[0];
        // Año mes dia
        $nuevaFecha = explode('-', $nuevaFecha);
        $petData[0]->bird_date = $nuevaFecha[1] . "/" . $nuevaFecha[2] . "/" .  $nuevaFecha[0];
        $inquiry = DB::select(DB::raw("select * from inquiry where pet_id = '$petId' ORDER BY inquiry_id DESC"));
        $clientName = DB::select(DB::raw("select clients.name, clients.surname1 from clients inner join pets on client_id=owner where pet_id= '$petId'"));
      } catch(InvalidArgumentException $exception) {
        return redirect()->back()->with('error','Datos no encontrados.');
      }
      return view('historial')->with('petData',$petData)->with('inquiry',$inquiry)->with('clientName', $clientName);
    }

      public function addInquiry(Request $request){
        try {
          $petId = $request->input('pet_id');
          DB::table('inquiry')->insertGetId(
            array('pet_id' => $request->input('pet_id'),
            'vet_id' => Auth::user()->user_id,
            'title' => $request->input('title'),
            'inquiry_date' => Carbon::now(),
            'diagnostic' => $request->input('diagnostic'),
            'observations' => $request->input('observations'),
            'treatment' => $request->input('treatment'))
          );
          $petData = DB::select(DB::raw("select * from pets where pet_id = '$petId'"));
          $inquiry = DB::select(DB::raw("select * from inquiry where pet_id = '$petId' ORDER BY inquiry_id DESC"));
          $clientName = DB::select(DB::raw("select clients.name, clients.surname1 from clients inner join pets on client_id=owner where pet_id= '$petId'"));

        } catch(Exception $exception) {
          $petData = DB::select(DB::raw("select * from pets where pet_id = '$petId'"));
          $inquiry = DB::select(DB::raw("select * from inquiry where pet_id = '$petId' ORDER BY inquiry_id DESC"));
          $clientName = DB::select(DB::raw("select clients.name, clients.surname1 from clients inner join pets on client_id=owner where pet_id= '$petId'"));
          return view('historial')->with('petData',$petData)->with('inquiry',$inquiry)->with('clientName', $clientName)->with('error', 'Datos no guardados');
        }
        return view('historial')->with('petData',$petData)->with('inquiry',$inquiry)->with('clientName', $clientName)->with('succes', 'Datos guardados');
      }

      public function updatePet(Request $request){
        try {
          $petId = $request->input('pet_id');
          $weight = $request->input('weight');
          $weight = str_replace(',','.',$weight);
          $weight = str_replace('\'','.',$weight);
          DB::table('pets')->where('pet_id',$petId)->update(
            ['name'=>$request->input('petName'),
            'chip_id'=>$request->input('chip_id'),
            'specie'=>$request->input('specie'),
            'breed'=>$request->input('breed'),
            'bird_date'=>Carbon::createFromFormat('m/d/Y', $request->input('birth_date')),
            'weight'=>$weight
          ]);

          $petData = DB::select(DB::raw("select * from pets where pet_id = '$petId'"));
          $inquiry = DB::select(DB::raw("select * from inquiry where pet_id = '$petId' ORDER BY inquiry_id DESC"));
          $clientName = DB::select(DB::raw("select clients.name, clients.surname1 from clients inner join pets on client_id=owner where pet_id= '$petId'"));

        } catch(Exception $exception) {
          $petData = DB::select(DB::raw("select * from pets where pet_id = '$petId'"));
          $inquiry = DB::select(DB::raw("select * from inquiry where pet_id = '$petId' ORDER BY inquiry_id DESC"));
          $clientName = DB::select(DB::raw("select clients.name, clients.surname1 from clients inner join pets on client_id=owner where pet_id= '$petId'"));
          $nuevaFecha =  $petData[0]->bird_date;
          $nuevaFecha = explode(' ', $nuevaFecha);
          $nuevaFecha = $nuevaFecha[0];
          // Año mes dia
          $nuevaFecha = explode('-', $nuevaFecha);
          $petData[0]->bird_date = $nuevaFecha[1] . "/" . $nuevaFecha[2] . "/" .  $nuevaFecha[0];
          return view('historial')->with('petData',$petData)->with('inquiry',$inquiry)->with('clientName', $clientName);
        }
        $nuevaFecha =  $petData[0]->bird_date;
        $nuevaFecha = explode(' ', $nuevaFecha);
        $nuevaFecha = $nuevaFecha[0];
        // Año mes dia
        $nuevaFecha = explode('-', $nuevaFecha);
        $petData[0]->bird_date = $nuevaFecha[1] . "/" . $nuevaFecha[2] . "/" .  $nuevaFecha[0];
        return view('historial')->with('petData',$petData)->with('inquiry',$inquiry)->with('clientName', $clientName);
      }
}

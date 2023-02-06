<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AltaController extends Controller
{
    // si no inicias sesion te redirige al inicio
    public function __construct()
    {
        $this->middleware('auth');
      }

    public function ownerRegister(Request $request){

      // If password doesn't match with password_confirmation show an error message
      if ($request->input('password') != $request->input('password-confirm')){
        return redirect()->back()->with('error','Diferent passwords');
      }

      try {
        // Insert new client into the DDBB
        DB::table('clients')->insertGetId(
          array('name' => $request->input('name'),
          'surname1' => $request->input('surname1'),
          'surname2' => $request->input('surname2'),
          'dni' => $request->input('dni'),
          'email' => $request->input('email'),
          'address' => $request->input('address'),
          'zip_code' => $request->input('zip_code'),
          'phone1' => $request->input('phone1'),
          'phone2' => $request->input('phone2'),
          'password' => Hash::make($request->input('password')))
        );

      } catch (\Illuminate\Database\QueryException $exception) {
        return redirect()->back()->with('error', 'Este cliente ya está registrado');

      } catch (Exception $exception) {
        return redirect()->back()->with('error', 'Datos no guardados');
      }
      return redirect()->back()->with('success', 'Dueño registrado');
    }

    public function petRegister(Request $request){

      try {
        $weight = $request->input('weight');
        $weight = str_replace(',','.',$weight);
        $weight = str_replace('\'','.',$weight);
        // Catch owner's dni
        $dniClient = empty($request->input('dni'))?'0':$request->input('dni');
        $clientId = DB::select(DB::raw("select client_id from clients where dni = '$dniClient'"));

        // Insert new pet into the DDBB
        DB::table('pets')->insertGetId(
          array('owner' => $clientId[0]->client_id,
          'name' => $request->input('petName'),
          'chip_id' => $request->input('chip_id'),
          'specie' => $request->input('specie'),
          'breed' => $request->input('breed'),
          'bird_date' => Carbon::createFromFormat('m/d/Y', $request->input('birth_date')),
          'weight' => $weight)
        );
        return redirect()->back()->with('success', 'Mascota registrada');
      } catch (Exception $exception){
        return redirect()->back()->with('success', 'Mascota no registrada');
      }

    }

    public function userProfile(Request $request){
      try {
        // Save user data in a variable
        $user = Auth::user();
        // Other way
        //$user = auth()->user();

        return view('perfil')->with('user',$user);
      } catch (Exception $exception){
        return view('perfil');
      }

    }

    public function updateUser(Request $request){

      try {
        $user = Auth::user();
        $userId = $user->user_id;
        // If new email doesn't have emai_confirm show an error message
        if($request->input('email') != $user->email){
          if($request->input('email') != $request->input('email_confirm')){
            return redirect()->back()->with('error','Diferent emails');
          }
        }

        // If input password doesn't have anything keep the password and update DDBB
        if($request->input('password') == null){
          DB::table('users')->where('user_id',$userId)->update(
            ['name'=>$request->input('name'),
            'surname1'=>$request->input('surname1'),
            'surname2'=>$request->input('surname2'),
            'dni'=>$request->input('dni'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'zip_code'=>$request->input('zip_code'),
            'phone1'=>$request->input('phone1'),
            'phone2'=>$request->input('phone2'),
            'user_role'=>$request->input('user_role')
          ]);

          // If new password match with password_confirmation update the DDBB
        } else if ($request->input('password') == $request->input('password_confirmation')){
          DB::table('users')->where('user_id',$userId)->update(
            ['name'=>$request->input('name'),
            'surname1'=>$request->input('surname1'),
            'surname2'=>$request->input('surname2'),
            'dni'=>$request->input('dni'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'zip_code'=>$request->input('zip_code'),
            'phone1'=>$request->input('phone1'),
            'phone2'=>$request->input('phone2'),
            'password'=>Hash::make($request->input('password')),
            'user_role'=>$request->input('user_role'),
          ]);
        } else {
          return redirect()->back()->with('error','Diferents passwords');
        }
      } catch (\Illuminate\Database\QueryException $exception){
        return redirect()->back()->with('error', 'Datos no cambiados. Dni o E-Mail existenes.');
      } catch (Exception $exception) {
        return redirect()->back()->with('error', 'Datos no cambiados.');
      }
      return redirect()->back()->with('success','Datos cambiados');
    }

    public function updateClient(Request $request){
      try{
        $clientId = $request->input('client_id');
        // If input password doesn't have anything keep the password and update DDBB
        $clientId = $request->input('client_id');
        $petsInfo = DB::select(DB::raw("select * from pets where owner = '$clientId'"));

        if($request->input('password') == null){

          DB::table('clients')->where('client_id',$clientId)->update(
            ['name'=>$request->input('name'),
            'surname1'=>$request->input('surname1'),
            'surname2'=>$request->input('surname2'),
            'dni'=>$request->input('dni'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'zip_code'=>$request->input('zip_code'),
            'phone1'=>$request->input('phone1'),
            'phone2'=>$request->input('phone2')
          ]);

          // If new password match with password_confirmation update the DDBB
        } else if ($request->input('password') == $request->input('password_confirmation')){
          DB::table('clients')->where('client_id',$clientId)->update(
            ['name'=>$request->input('name'),
            'surname1'=>$request->input('surname1'),
            'surname2'=>$request->input('surname2'),
            'dni'=>$request->input('dni'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'zip_code'=>$request->input('zip_code'),
            'phone1'=>$request->input('phone1'),
            'phone2'=>$request->input('phone2'),
            'password'=>Hash::make($request->input('password'))
          ]);
        } else {
        	$client = $this->clientProfileId($request, $clientId);
          return view('buscadorClientes')->with('petsInfo', $petsInfo)->with('client', $client[0])->with('error','Diferents passwords');;
        }
      } catch(\Illuminate\Database\QueryException $exception){
        $client = $this->clientProfileId($request, $clientId);
        return view('buscadorClientes')->with('petsInfo', $petsInfo)->with('client', $client[0]);
        
      } catch (Exception $exception){
        $client = $this->clientProfileId($request, $clientId);
        return view('buscadorClientes')->with('petsInfo', $petsInfo)->with('client', $client[0]);
      }
      $client = $this->clientProfileId($request, $clientId);
      return view('buscadorClientes')->with('petsInfo', $petsInfo)->with('client', $client[0])->with('success', "Datos cambiados");
    }


    public function clientProfileId(Request $request, String $clientId){
      try{
        // Save client data in a variable
        $client = DB::select(DB::raw("select * from clients where client_id = '$clientId'"));;
        // Other way
        //$user = auth()->user();
        return $client;
      } catch(Exception $exception){
        return "";
      }

    }
}

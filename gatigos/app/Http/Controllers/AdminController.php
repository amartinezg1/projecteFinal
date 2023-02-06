<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // si no inicias sesion te redirige al inicio
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function listAllUsers(Request $request)
    {
    //$listaUsuariosView =  array();
    //$listaUsuariosView['allUsers'] = DB::select(DB::raw("select * from users"));
    //$listaUsuariosView['allRoles'] = DB::select(DB::raw("select * from users"));
    $allUsers = DB::select(DB::raw("select * from users"));
    $allRoles = DB::select(DB::raw("select distinct(user_role) from users"));
    $active = DB::select(DB::raw("select distinct(active) from users"));
    return view('listarUsuarios')->with('users', $allUsers)->with('roles', $allRoles)->with('actives', $active);
    }

    public function updateUser(Request $request){
      $userId = empty($request->input('user_id'))?'0':$request->input('user_id');
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
          'active'=>$request->input('active'),
          'user_role'=>$request->input('user_role')
        ]);

      return redirect()->back()->with('success','Datos cambiados');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Consultas;
use Carbon\Carbon;
use Exception;
use Mail;
use App\Mail\NoticeMail;
class VetController extends Controller
{
    // si no inicias sesion te redirige al inicio
    public function __construct()
    {
      $this->middleware('auth');
    }

    // Devuelve las citas del veterinario del día seleccionado.
    public function searchProxDates(Request $request){
     // auth()->id()
     $userId = auth()->id();
     $userVetData = DB::select(DB::raw("select * from users where user_id='$userId'"));
     $datesInfo = DB::select(DB::raw("select * from jqcalendar where color='$userId'"));
      return view('misCitas')->with('userVet',$userVetData[0])->with('datesInfo', $datesInfo);
    }
}

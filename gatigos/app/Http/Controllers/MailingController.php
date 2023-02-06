<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Consultas;
use Exception;
use Mail;
use App\Mail\NoticeMail;

class MailingController extends Controller
{
    // Funcion que envia un mail personalizado a todos los clientes que tengan cita el dia siguiente.
    public function alertMailingDates(Request $request) {
      // Buscamos todos los correos de los clientes con citas mañana.
      //$correos = DB::select(DB::raw("select Subject from jqcalendar where fecha=*******"));
      //Mail::to('amguallarad@gmail.com')->send(new NoticeMail($userVetData[0]));
    //  try{
        $tomorrow = Carbon::tomorrow();
        $tomorrow = explode(" ", $tomorrow->__toString());
        $tomorrow = $tomorrow[0];

        $correos = DB::select(DB::raw("select Subject, Location, StartTime from jqcalendar where StartTime LIKE '$tomorrow%'"));
        if($correos != null) {
          foreach ($correos as $cliente) {
            Mail::to($cliente->Location)->send(new NoticeMail($cliente));
          }
        }
        return redirect()->back()->with('success', 'Mails enviados con éxito!');
  //    } catch(Exception $exception) {
        return redirect()->back()->with('error','Mails no enviados.');
    //  }
    }
}

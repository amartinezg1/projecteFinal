<?php

namespace App\Http\Middleware;

use Closure;

class AltasPetsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
       $petName = trim($request->petName);
       $dniOwner = trim($request->dni);
       $dniOwner = strtoupper($dniOwner);
       $specie = trim($request->specie);
       $breed = trim($request->breed);
       $weight = trim($request->weight);


       if(self::validateDni($dniOwner) && self::validateWeight($weight)){
         return $next($request);
       }
         return redirect()->back()->with('error','Datos incorrectos')->withinput();
     }

     public function validateNames($petName)
     {
       if(preg_match("/^[a-zA-Z-'\s]+$/",$petName) == 1){
         return true;
       }else{
         return false;
       }
     }
     public function validateDni($dniOwner)
     {
       $posibleLetras = "TRWAGMYFPDXBNJZSQVHLCKE";
       if(preg_match("/^[0-9]{8}[A-z]$/",$dniOwner) == 1){
         $numeros = substr($dniOwner,0,8);
                 $letra = substr($dniOwner,8,9);
                 $calcular = $numeros % 23;
                 $resultadoLetra = $posibleLetras{$calcular};
                 if($resultadoLetra != $letra){
                     return false;
                 }else{
                     return true;
                 }
             }else {
                 return false;
             }
     }
     public function validateWeight($weight)
     {
       if(preg_match("/^(0|[1-9]\d*)(.\d+)?$/",$weight) == 1){
         return true;
       }else{
         return false;
       }
     }
}

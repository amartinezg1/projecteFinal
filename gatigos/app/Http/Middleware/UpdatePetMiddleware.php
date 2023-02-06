<?php

namespace App\Http\Middleware;

use Closure;

class UpdatePetMiddleware
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

       $weight = trim($request->weight);


       if(self::validateWeight($weight)){
         return $next($request);
       }
         return redirect()->back()->with('error','Formato de peso incorrecto. Ex: 12.06');
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
       $weight = str_replace(',','.',$weight);
       if(preg_match("/^(0|[1-9]\d*)(.\d+)?$/",$weight) == 1){
         return true;
       }else{
         return false;
       }
     }
}

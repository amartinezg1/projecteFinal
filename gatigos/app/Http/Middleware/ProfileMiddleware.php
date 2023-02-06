<?php

namespace App\Http\Middleware;

use Closure;

class ProfileMiddleware
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
       //$name = trim($request->name);
       //$surname1 = trim($request->surname1);
       //$surname2 = trim($request->surname2);
       $dni = trim($request->dni);
       $dni = strtoupper($dni);
       $email = trim($request->email);
       //$address = trim($request->address);
       $zip_code = trim($request->zip_code);
       $phone1 = trim($request->phone1);
       //$phone2 = trim($request->phone2);


       if(self::validateDni($dni) && self::validateEmail($email) && self::validatePhones($phone1)){
         return $next($request);
       }
         return redirect()->back()->with('error','Datos incorrectos')->withinput();
     }

     public function validateDni($dni)
     {
       $posibleLetras = "TRWAGMYFPDXBNJZSQVHLCKE";
       if(preg_match("/^[0-9]{8}[A-z]$/",$dni) == 1){
         $numeros = substr($dni,0,8);
                 $letra = substr($dni,8,9);
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
     public function validateEmail($email)
     {
       if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/",$email) == 1){
         return true;
       }else{
         return false;
       }
     }
     public function validatePhones($phone)
     {
       if(preg_match("/^(\+34|0034|34)?[6789][0-9]{8}$/",$phone) == 1){
         return true;
       }else{
         return false;
       }
     }
}

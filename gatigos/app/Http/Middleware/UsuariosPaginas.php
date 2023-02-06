<?php

namespace App\Http\Middleware;

use Closure;

class UsuariosPaginas
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
       $dni = trim($request->dni);
       $dni = strtoupper($dni);
       if(self::validatedni($dni)){
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
}

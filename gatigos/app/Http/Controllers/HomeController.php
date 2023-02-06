<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function buscadorClientes() {
    	return view('buscadorClientes');
    }
    public function historial() {
    	return view('historial');
    }
    public function index()
    {
        return view('sample');
    }
}

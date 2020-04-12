<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {
       $id_usuario_logueado=auth()->id();
       $fecha_actual=date('Y-m-d');
       $users_logueado = DB::table('users')
            ->leftJoin('datos_users', 'users.id', '=', 'datos_users.id_user')->where('users.id','=',$id_usuario_logueado)
            ->get();

        // $users = DB::table('users')
        //     ->leftJoin('datos_users', 'users.id', '=', 'datos_users.id_user')->where('users.id','!=',$id_usuario_logueado)
        //     ->leftJoin('entradas_users','users.id','!=','entradas_users.id_user')
        //     ->whereNull('updated_at')
        //     ->orWhere('fecha_entrada',$fecha_actual)
        //     ->select('users.*','datos_users.*','entradas_users.*')
        //     ->get();

        $users = DB::table('entradas_users')
        ->rightJoin('users','entradas_users.id_user','=','users.id')->where('users.id','!=',$id_usuario_logueado)
        ->whereNull('fecha_entrada')
        ->orWhere('fecha_entrada',$fecha_actual)
        ->leftJoin('datos_users', 'users.id', '=', 'datos_users.id_user')
        ->get();

            return view('home',compact('users','users_logueado'));
    }
}

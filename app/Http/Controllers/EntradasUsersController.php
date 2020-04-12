<?php

namespace App\Http\Controllers;
use App\User;
use App\Area;
use App\entradas_users;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EntradasUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //SELECT * FROM reabastecers INNER JOIN productos on reabastecers.id_producto=productos.id
        $ini="";
        $fin="";
        $area="";
        $data_reporte="";
      
        if(($ini==""&&$fin=="")&& $area=="")
        {
             $data_reporte = DB::table('entradas_users')
            ->join('users', 'entradas_users.id_user', '=','users.id')
            ->where('fecha_entrada','!=',NULL)
            ->where('fecha_salida','!=',NULL)
            ->join('datos_users','users.id','=','datos_users.id_user')
            ->join('areas','areas.id','=','users.id_area')
            ->select('entradas_users.*', 'users.email','areas.area_new','datos_users.*')
            ->get();
         }
        
        $areas=Area::all();

        return view('Areas.reporte',compact('areas','data_reporte'));

    }

    public function imprimir(Request $request)
    {

        $data=$request->all();
       
        $ini=is_null($data['fecha_ini'])?"":$data['fecha_ini'];
        $fin=is_null($data['fecha_fin'])?"":$data['fecha_fin'];
        $area=isset($data['area_perfil'])?$data['area_perfil']:'';
        $data_reporte="";
        
        if($ini==""&&$fin!="")
        {$ini=$fin;$fin="";}

        if($fin==""&&$ini!="")
        {$fin=date('Y-m-d');}

        if($ini>$fin){
            $temporal=$fin;
            $fin=$ini;
            $ini=$temporal;
        }
        if(($ini==""&&$fin=="")&& $area=="")
        {
            $data_reporte = DB::table('entradas_users')
            ->join('users', 'entradas_users.id_user', '=','users.id')
            ->where('fecha_entrada','!=',NULL)
            ->where('fecha_salida','!=',NULL)
            ->join('datos_users','users.id','=','datos_users.id_user')
            ->join('areas','areas.id','=','users.id_area')
            ->select('entradas_users.*', 'users.email','areas.area_new','datos_users.*')
            ->get();
        }
        
        if(($ini==""&&$fin=="")&& $area!="")
        {
            $data_reporte = DB::table('entradas_users')
            ->join('users', 'entradas_users.id_user', '=','users.id')
            ->where('fecha_entrada','!=',NULL)
            ->where('fecha_salida','!=',NULL)
            ->join('datos_users','users.id','=','datos_users.id_user')
            ->join('areas','areas.id','=','users.id_area')
            ->where('areas.id','=',$area)
            ->select('entradas_users.*', 'users.email','areas.area_new','datos_users.*')
            ->get();
        }
        if(($ini!=""&&$fin!="")&& $area=="")
        {
            $data_reporte = DB::table('entradas_users')
            ->join('users', 'entradas_users.id_user', '=','users.id')
            ->where('fecha_entrada','!=',NULL)
            ->where('fecha_salida','!=',NULL)
            ->whereBetween('fecha_entrada', [$ini,$fin])
            ->join('datos_users','users.id','=','datos_users.id_user')
            ->join('areas','areas.id','=','users.id_area')
            ->select('entradas_users.*', 'users.email','areas.area_new','datos_users.*')
            ->get();
        }
        

     
        $pdf = \PDF::loadView('Areas.print_usuarios',compact('data_reporte'));
        return $pdf->download('reporte.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\entradas_users  $entradas_users
     * @return \Illuminate\Http\Response
     */
    public function show(entradas_users $entradas_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\entradas_users  $entradas_users
     * @return \Illuminate\Http\Response
     */
    public function edit(entradas_users $entradas_users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\entradas_users  $entradas_users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entradas_users $entradas_users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\entradas_users  $entradas_users
     * @return \Illuminate\Http\Response
     */
    public function destroy(entradas_users $entradas_users)
    {
        //
    }
  
}

<?php

namespace App\Http\Controllers;

use App\datos_users;
use Illuminate\Http\Request;
use App\User;
use App\Area;
use App\entradas_users;
use App\Rules\validacionCorreo;
use App\Rules\validacionTelefono;
use Illuminate\Support\Facades\DB;


class DatosUsersController extends Controller
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
        $areas=Area::all();

        return view('auth.register',compact('areas'));
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
    
        $data=$request->all();

        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'paterno' => 'required|max:50',
            'materno' => 'required|max:50',
            'email' => 'required|email|unique:users|max:50',
            'telefono' => 'required|numeric|unique:datos_users',
            'direccion' => 'required|max:100',
            'area'=>'required|numeric'
        ]);


        $table_users=new User;

        $table_users->email=trim($data['email']);
        $table_users->password=bcrypt('password');
        $table_users->id_area=trim($data['area']);
        $table_users->save();
        $id_actual=$table_users->id;

        $table_data_user=new datos_users;
        $table_data_user->nombre=trim($data['name']);
        $table_data_user->paterno=trim($data['paterno']);
        $table_data_user->materno=trim($data['materno']);
        $table_data_user->telefono=trim($data['telefono']);
        $table_data_user->direccion=trim($data['direccion']);
        $table_data_user->id_user=$id_actual;
        $table_data_user->save();

        return redirect('allUser/'.$id_actual.'/edit')->with('status', 'Datos Guardados con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\datos_users  $datos_users
     * @return \Illuminate\Http\Response
     */
    public function show(datos_users $datos_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\datos_users  $datos_users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        User::findOrFail($id);
        $user_edit = DB::table('users')
        ->leftJoin('datos_users', 'users.id', '=', 'datos_users.id_user')->where('users.id',$id)
        ->select('users.*', 'datos_users.*')
        ->get();
        //dd($user_edit);
        $areas=Area::all();
        return view('auth.register',compact('user_edit','areas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\datos_users  $datos_users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //id => table control_usuario
        $id_users=$id;
        $data_update=$request->all();
        $id_user_control_usuario=$data_update['id_user'];
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'paterno' => 'required|max:50',
            'materno' => 'required|max:50',
            'email' => ['required','email','max:50','sometimes','unique:users,email,'.$id_users],
            'telefono' => ['required','numeric','sometimes','unique:datos_users,telefono,'.$id_user_control_usuario],
            'direccion' => 'required|max:100',
            'area'=>'required|numeric'
        ]);

        DB::table('users')
        ->where('id', $id_users)
        ->update(
            [
                'email'=>trim($data_update['email']),
                'id_area' => trim($data_update['area'])
            ]
        );
        
        DB::table('datos_users')
        ->where('id',$data_update['id_user'])
        ->update(
            [
                'nombre'=>trim($data_update['name']),
                'paterno'=>trim($data_update['paterno']),
                'materno'=>trim($data_update['materno']),
                'telefono'=>trim($data_update['telefono']),
                'direccion'=>trim($data_update['direccion'])
            ]
        );

        return redirect('allUser/'.$id_users.'/edit')->with('status', 'Datos actualizados con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\datos_users  $datos_users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data=$request->all();
        $statusNew=$data['status_user'];
        $user=User::findOrFail($id);
        
        $user->activo=$statusNew;
        $user->save();

        return redirect('/home')->with('status', 'Usuario  '.$statusNew.' con exito');

    }

    public function entrada(Request $request, $id)
    {
        $data=$request->all();
      
        $user=User::findOrFail($id);
        $id_user=$user->id;
        if($data['control_salida']==="entrada"){
            $entra_salidas=new entradas_users;

            $entra_salidas->fecha_entrada=date('Y-m-d');
            $entra_salidas->hora_entrada=date('H:i:s');
            $entra_salidas->id_user=$id_user;    
        }
        else{
            $entra_salidas=entradas_users::where('id_user',$id)->first();
            $entra_salidas->fecha_salida=date('Y-m-d');
            $entra_salidas->hora_salida=date('H:i:s');
        }
          $entra_salidas->save();
        


        return redirect('/home')->with('','')->with('status', $data['control_salida'].' registrada con exito');

    }
}

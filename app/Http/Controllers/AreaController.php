<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas=Area::all();
        return view('Areas.index',compact('areas'));
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
        $data=$request->all();

        
        $validatedData = $request->validate([
            'area_new' => 'required|max:50|unique:areas',
        ]);
        $table_areas=new Area;
        $table_areas->area_new=trim($data['area_new']);
        $table_areas->save();

        return redirect('/Areas')->with('status', 'Área Registrada con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
            $area_edit=Area::findOrFail($id);
            $areas=Area::all();
               
            return view('Areas.actualizar',compact('area_edit','areas'));
        // $area->activo=$statusNew;
        // $area->save();
        // $statusNew=$statusNew=="activo"?'Habilitado':'Inhabilitado';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //id => table control_usuario
        $data=$request->all();
        $area_update=Area::findOrFail($id);
        
        $validatedData = $request->validate([
            'area_new' => ['required','string','max:50','sometimes','unique:areas,area_new,'.$area_update->id],
        ]);

        $area_update->area_new=$data['area_new'];
        return redirect('Areas/'.$area_update->id.'/edit')->with('status', 'Area actualizada con exito');
     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data=$request->all();
        $statusNew=$data['status_area'];
        
        $area=Area::findOrFail($id);
        
        $area->activo=$statusNew;
        $area->save();
        $statusNew=$statusNew=="activo"?'Habilitado':'Inhabilitado';
        return redirect('/Areas')->with('status', 'Area  '.$statusNew.' con exito');

    }
}

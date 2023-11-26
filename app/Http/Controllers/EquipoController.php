<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    //
    public function index(){
        $equipos = equipo::all();
        return response()->json($equipos);
    }
    public function store(Request $request){
        $rules = ['nombreEquipo' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $equipos = new equipo($request->input());
        $equipos->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el equipo'
        ],200);
    }
    public function show(equipo $equipos){
        return response()->json(['status'=>true, 'data'=>$equipos]);
    }
    public function update(Request $request, equipo $equipos){
        $rules = ['nombreEquipo' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $equipos->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el equipo'
        ],200);
    }
    public function destroy(equipo $equipos){
        $equipos->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el equipo'
        ],200);
    }
}

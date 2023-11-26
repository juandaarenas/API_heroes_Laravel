<?php

namespace App\Http\Controllers;

use App\Models\tipo_mision;
use Illuminate\Http\Request;

class Tipo_misionController extends Controller
{
    //
    public function index(){
        $tipoMision = tipo_mision::all();
        return response()->json($tipoMision);
    }
    public function store(Request $request){
        $rules = ['nombreTmision' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $tipoMision = new tipo_mision($request->input());
        $tipoMision->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el tipo de mision'
        ],200);
    }
    public function show(tipo_mision $tipoMision){
        return response()->json(['status'=>true, 'data'=>$tipoMision]);
    }
    public function update(Request $request, tipo_mision $tipoMision){
        $rules = ['nombreTmision' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $tipoMision->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el tipo de mision'
        ],200);
    }
    public function destroy(tipo_mision $tipoMision){
        $tipoMision->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el tipo de mision'
        ],200);
    }
}

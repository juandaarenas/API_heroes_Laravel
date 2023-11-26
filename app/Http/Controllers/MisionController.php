<?php

namespace App\Http\Controllers;

use App\Models\mision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MisionController extends Controller
{
    //
    public function index(){
        $mision = mision::all();
        return response()->json($mision);
    }
    public function store(Request $request){
        $rules = ['mision' => 'required|string','tipo_mision_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $mision = new mision($request->input());
        $mision->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado la mision'
        ],200);
    }
    public function show(mision $mision){
        return response()->json(['status'=>true, 'data'=>$mision]);
    }
    public function update(Request $request, mision $mision){
        $rules = ['mision' => 'required|string','tipo_mision_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $mision->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado la mision'
        ],200);
    }
    public function destroy(mision $mision){
        $mision->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado la mision'
        ],200);
    }
    public function misionByTipoMision(){
        $misiones = mision::select(DB::raw('count(misions.id) as count',
        'tipo_misions.nombreTmision'))->join('tipo_misions','tipo_misions.id','=','misions.tipo_mision_id')->groupBy('tipo_misions.nombreTmision')->get();
        return response()->json($misiones);
    }
    public function todomision(){
        $misiones = mision::select('misions.*',
        'tipo_misions.nombreTmision as TipoMision')->join('tipo_misions','tipo_misions.id','=','misions.tipo_mision_id')->get();
        return response()->json($misiones);
    }
}
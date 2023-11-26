<?php

namespace App\Http\Controllers;

use App\Models\mision_superheroes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Mision_superheroesController extends Controller
{
    //
    public function index(){
        $misionGrupal = mision_superheroes::all();
        return response()->json($misionGrupal);
    }
    public function store(Request $request){
        $rules = ['agrupacion_id' => 'required|numeric','misiones_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $misionGrupal = new mision_superheroes($request->input());
        $misionGrupal->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado la mision grupal'
        ],200);
    }
    public function show(mision_superheroes $misionGrupal){
        return response()->json(['status'=>true, 'data'=>$misionGrupal]);
    }
    public function update(Request $request, mision_superheroes $misionGrupal){
        $rules = ['agrupacion_id' => 'required|numeric','misiones_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $misionGrupal->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado la mision grupal'
        ],200);
    }
    public function destroy(mision_superheroes $misionGrupal){
        $misionGrupal->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado la mision grupal'
        ],200);
    }
    public function misionBySolo(){
        $misionGrupales =[ mision_superheroes::select(DB::raw('count(mision_superheroes.agrupacion_id) as count',
        'agrupacions.equipos_id'))->join('agrupacions','agrupacions.id','=','mision_superheroes.agrupacion_id')->groupBy('agrupacions.equipos_id')->get(),
        mision_superheroes::select(DB::raw('count(mision_superheroes.misiones_id) as count',
        'misions.mision'))->join('misions','misions.id','=','mision_superheroes.misiones_id')->groupBy('misions.mision')->get()
    ];
        return response()->json($misionGrupales);
    }
    public function todoMisionSolo(){
        $misionGrupales = [ mision_superheroes::select('mision_superheroes.agrupacion_id',
        'agrupacions.equipos_id as idAgrupacion')->join('agrupacions','agrupacions.id','=','mision_superheroes.agrupacion_id')->get(),
        mision_superheroes::select('mision_superheroes.misiones_id',
        'misions.mision as Mision')->join('misions','misions.id','=','mision_superheroes.misiones_id')->get()
    ];
        return response()->json($misionGrupales);
    }
}

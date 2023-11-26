<?php

namespace App\Http\Controllers;

use App\Models\agrupacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgrupacionController extends Controller
{
    //
    public function index(){
        $grupo = agrupacion::all();
        return response()->json($grupo);
    }
    public function store(Request $request){
        $rules = ['superheroe_id' => 'required|numeric','equipos_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $grupo = new agrupacion($request->input());
        $grupo->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado la agrupacion'
        ],200);
    }
    public function show(agrupacion $grupo){
        return response()->json(['status'=>true, 'data'=>$grupo]);
    }
    public function update(Request $request, agrupacion $grupo){
        $rules = ['superheroe_id' => 'required|numeric','equipos_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $grupo->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado la agrupacion'
        ],200);
    }
    public function destroy(agrupacion $grupo){
        $grupo->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado la agrupacion'
        ],200);
    }
    public function agrupacionByHeroesEquipos(){
        $grupos =[ agrupacion::select(DB::raw('count(agrupacions.superheroe_id) as count',
        'superheroes.nombreHeroe'))->join('superheroes','superheroes.id','=','agrupacions.superheroe_id')->groupBy('superheroes.nombreHeroe')->get(),
        agrupacion::select(DB::raw('count(agrupacions.equipos_id) as count',
        'equipos.nombreEquipo'))->join('equipos','equipos.id','=','agrupacions.equipos_id')->groupBy('equipos.nombreEquipo')->get()
    ];
        return response()->json($grupos);
    }
    public function todoAgrupacion(){
        $grupos = [ agrupacion::select('agrupacions.superheroe_id',
        'superheroes.nombreHeroe as superHeroe')->join('superheroes','superheroes.id','=','agrupacions.superheroe_id')->get(),
        agrupacion::select('agrupacions.equipos_id',
        'equipos.nombreEquipo as Equipos')->join('equipos','equipos.id','=','agrupacions.equipos_id')->get()
    ];
        return response()->json($grupos);
    }
}
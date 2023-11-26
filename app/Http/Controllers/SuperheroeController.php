<?php

namespace App\Http\Controllers;

use App\Models\superheroe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperheroeController extends Controller
{
    //
    public function index(){
        $heroe = superheroe::all();
        return response()->json($heroe);
    }
    public function store(Request $request){
        $rules = ['nombreHeroe' => 'required|string','edad' => 'required|numeric','planetas_id'=> 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $heroe = new superheroe($request->input());
        $heroe->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el heroe'
        ],200);
    }
    public function show(superheroe $heroe){
        return response()->json(['status'=>true, 'data'=>$heroe]);
    }
    public function update(Request $request, superheroe $heroe){
        $rules = ['nombreHeroe' => 'required|string','edad' => 'required|numeric','planetas_id'=> 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $heroe->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el heroe'
        ],200);
    }
    public function destroy(superheroe $heroe){
        $heroe->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el heroe'
        ],200);
    }
    public function HeroesByPlanetas(){
        $heroes = superheroe::select(DB::raw('count(superheroes.id) as count',
        'planetas.nombrePlaneta'))->join('planetas','planetas.id','=','superheroes.planetas_id')->groupBy('planetas.nombrePlaneta')->get();
        return response()->json($heroes);
    }
    public function todoheroes(){
        $heroes = superheroe::select('superheroes.*',
        'planetas.nombrePlaneta as planet')->join('planetas','planetas.id','=','superheroes.planetas_id')->get();
        return response()->json($heroes);
    }
}

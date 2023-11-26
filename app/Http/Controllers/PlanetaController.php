<?php

namespace App\Http\Controllers;

use App\Models\planeta;
use Illuminate\Http\Request;

class PlanetaController extends Controller
{
    //
    public function index(){
        $planetas = planeta::all();
        return response()->json($planetas);
    }
    public function store(Request $request){
        $rules = ['nombrePlaneta' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $planetas = new planeta($request->input());
        $planetas->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el planeta'
        ],200);
    }
    public function show(planeta $planetas){
        return response()->json(['status'=>true, 'data'=>$planetas]);
    }
    public function update(Request $request, planeta $planetas){
        $rules = ['nombrePlaneta' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $planetas->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el planeta'
        ],200);
    }
    public function destroy(planeta $planetas){
        $planetas->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el planeta'
        ],200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\poderes_superheroe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Poderes_superheroeController extends Controller
{
    //
    public function index(){
        $poderHeroe = poderes_superheroe::all();
        return response()->json($poderHeroe);
    }
    public function store(Request $request){
        $rules = ['superheroe_id' => 'required|numeric','superpoderes_id' => 'required|numeric','niveles'=>'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $poderHeroe = new poderes_superheroe($request->input());
        $poderHeroe->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el poder del heroe'
        ],200);
    }
    public function show(poderes_superheroe $poderHeroe){
        return response()->json(['status'=>true, 'data'=>$poderHeroe]);
    }
    public function update(Request $request, poderes_superheroe $poderHeroe){
        $rules = ['superheroe_id' => 'required|numeric','superpoderes_id' => 'required|numeric','niveles'=>'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $poderHeroe->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el poder del heroe'
        ],200);
    }
    public function destroy(poderes_superheroe $poderHeroe){
        $poderHeroe->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el poder del heroe'
        ],200);
    }
    public function poderesByHeroes(){
        $poderesHeroes =[ poderes_superheroe::select(DB::raw('count(poderes_superheroes.superheroe_id) as count',
        'superheroes.nombreHeroe'))->join('superheroes','superheroes.id','=','poderes_superheroes.superheroe_id')->groupBy('superheroes.nombreHeroe')->get(),
        poderes_superheroe::select(DB::raw('count(poderes_superheroes.superpoderes_id) as count',
        'superpoders.poder'))->join('superpoders','superpoders.id','=','poderes_superheroes.superpoderes_id')->groupBy('superpoders.poder')->get()
    ];
        return response()->json($poderesHeroes);
    }
    public function todoPoderes(){
        $poderesHeroes = [ poderes_superheroe::select('poderes_superheroes.superheroe_id',
        'superheroes.nombreHeroe as superHeroe')->join('superheroes','superheroes.id','=','poderes_superheroes.superheroe_id')->get(),
        poderes_superheroe::select('poderes_superheroes.superpoderes_id',
        'superpoders.poder as superPoder')->join('superpoders','superpoders.id','=','poderes_superheroes.superpoderes_id')->get(),
        poderes_superheroe::select('poderes_superheroes.niveles')->get()
    ];
        return response()->json($poderesHeroes);
    }
}
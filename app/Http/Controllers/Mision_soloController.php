<?php

namespace App\Http\Controllers;

use App\Models\mision_solo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Mision_soloController extends Controller
{
    //
    public function index(){
        $misionSolo = mision_solo::all();
        return response()->json($misionSolo);
    }
    public function store(Request $request){
        $rules = ['superheroe_id' => 'required|numeric','misiones_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $misionSolo = new mision_solo($request->input());
        $misionSolo->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado la mision solitaria'
        ],200);
    }
    public function show(mision_solo $misionSolo){
        return response()->json(['status'=>true, 'data'=>$misionSolo]);
    }
    public function update(Request $request, mision_solo $misionSolo){
        $rules = ['superheroe_id' => 'required|numeric','misiones_id' => 'required|numeric'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $misionSolo->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado la mision solitaria'
        ],200);
    }
    public function destroy(mision_solo $misionSolo){
        $misionSolo->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado la mision solitaria'
        ],200);
    }
    public function misionBySolo(){
        $misionSolos =[ mision_solo::select(DB::raw('count(mision_solos.superheroe_id) as count',
        'superheroes.nombreHeroe'))->join('superheroes','superheroes.id','=','mision_solos.superheroe_id')->groupBy('superheroes.nombreHeroe')->get(),
        mision_solo::select(DB::raw('count(mision_solos.misiones_id) as count',
        'misions.mision'))->join('misions','misions.id','=','mision_solos.misiones_id')->groupBy('misions.mision')->get()
    ];
        return response()->json($misionSolos);
    }
    public function todoMisionSolo(){
        $misionSolos = [ mision_solo::select('mision_solos.superheroe_id',
        'superheroes.nombreHeroe as superHeroe')->join('superheroes','superheroes.id','=','mision_solos.superheroe_id')->get(),
        mision_solo::select('mision_solos.misiones_id',
        'misions.mision as Mision')->join('misions','misions.id','=','mision_solos.misiones_id')->get()
    ];
        return response()->json($misionSolos);
    }
}

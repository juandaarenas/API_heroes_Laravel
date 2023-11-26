<?php

namespace App\Http\Controllers;

use App\Models\superpoder;
use Illuminate\Http\Request;

class SuperpoderController extends Controller
{
    //
    public function index(){
        $poderes = superpoder::all();
        return response()->json($poderes);
    }
    public function store(Request $request){
        $rules = ['poder' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $poderes = new superpoder($request->input());
        $poderes->save();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha creado el poder'
        ],200);
    }
    public function show(superpoder $poderes){
        return response()->json(['status'=>true, 'data'=>$poderes]);
    }
    public function update(Request $request, superpoder $poderes){
        $rules = ['poder' => 'required|string'];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $poderes->update($request->input());
        return response()->json([
            'status'=>true,
            'message'=>'Se ha actualizado el poder'
        ],200);
    }
    public function destroy(superpoder $poderes){
        $poderes->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Se ha eliminado el poder'
        ],200);
    }
}
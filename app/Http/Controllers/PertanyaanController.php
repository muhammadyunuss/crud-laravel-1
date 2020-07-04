<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PertanyaanModel;
use App\JawabanModel;

class PertanyaanController extends Controller
{
    public function index(){
        $pertanyaan = PertanyaanModel::get();
        // dd($pertanyaan);
        return view('tabelpertanyaan', compact('pertanyaan'));
    }

    public function create(){
        return view('formpertanyaan');
    }

    public function store(Request $request){
        // dd($request->all());
        $pertanyaan = new PertanyaanModel;

        $data = $request->all();
        // unset($data["_token"]);
        // $pertanyaan = M_pertanyaan::save($data);
        // dd($pertanyaan);
        $pertanyaan->judul = $data['judul'];
        $pertanyaan->isi = $data['isi'];
        // dd($pertanyaan);
        $pertanyaan->save();
        return redirect('/pertanyaan');

    }

    public function edit($id){
        $getPertanyaan = PertanyaanModel::find($id);
        $getPertanyaan =json_decode(json_encode($getPertanyaan),true);
        return view('editpertanyaan',compact('getPertanyaan'));
    }

    public function update($id,Request $request){

        $getPertanyaan = PertanyaanModel::where('id', $id)->update($request->except('_token','_method'));
        return redirect('/pertanyaan');
    }

    public function destroy($id){
        PertanyaanModel::where('id',$id)->delete();
        JawabanModel::where('pertanyaan_id',$id)->delete();

        return redirect()->back();
    }
}

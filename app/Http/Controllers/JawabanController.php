<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JawabanModel;
use App\PertanyaanModel;

class JawabanController extends Controller
{
    public function index($id=null){
        $jawaban = new JawabanModel;
        // dd($id);
        $getJawaban = JawabanModel::where('pertanyaan_id',$id)->get();
        $getPertanyaan = PertanyaanModel::find($id);
        $getPertanyaan =json_decode(json_encode($getPertanyaan),true);
        // dd($getPertanyaan);
        return view('jawabanpertanyaan',compact('getJawaban','getPertanyaan'));
    }

    public function store(Request $request, $id=null){
        // dd($request->all());
        $jawaban = new JawabanModel;
        $data = $request->all();
        // unset($data["_token"]);
        // $pertanyaan = M_pertanyaan::save($data);
        // dd($pertanyaan);
        $jawaban->pertanyaan_id = $id;
        $jawaban->judul = $data['judul'];
        $jawaban->isi = $data['isi'];
        // dd($pertanyaan);
        $jawaban->save();
        return redirect("/jawaban/$id");

    }
}

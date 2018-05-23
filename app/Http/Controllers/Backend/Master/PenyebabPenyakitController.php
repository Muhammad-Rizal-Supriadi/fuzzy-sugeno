<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.47
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use App\Models\DiagnosaPenyakit;
use Illuminate\Http\Request;
use App\Models\RelationDiagnosaKlinis;
use App\Models\GejalaKlinis;

class PenyebabPenyakitController extends Controller
{
    public  function index(){

        $data = DiagnosaPenyakit::all();
        $params = [
            'title' => 'Manajemen Hubungan Penyakit Gejala Klinis',
            'data' => $data
        ];

        return view('backend.master.penyebab-penyakit.index',$params);


    }

    public  function  view(Request $request){

        $idDiagnosa = $request->get('id');
        $data = RelationDiagnosaKlinis::where(['diagnosa_penyakit_id' => $idDiagnosa])->get();
        $params = [
            'diagnosaPenyakit' => DiagnosaPenyakit::find($idDiagnosa),
            'title' => 'Manajemen Hubungan Penyakit Gejala Klinis',
            'data' => $data
        ];

        return view('backend.master.penyebab-penyakit.view',$params);
    }

    public  function form(Request $request){

        $idDiagnosa = $request->get('id_diagnosa');
        $id = $request->input('id');
        if($id){
            $data = RelationDiagnosaKlinis::find($id);
        }else{
            $data = new RelationDiagnosaKlinis();
        }

        $gejalaKlinis = GejalaKlinis::orderBy('id', 'ASC')->get();
        $diagnosaPenyakit = DiagnosaPenyakit::find($idDiagnosa);
        $params = [
            'title' => 'Manajemen Hubungan Penyakit Gejala Klinis',
            'data' => $data,
            'gejalaKlinis' => $gejalaKlinis,
            'diagnosaPenyakit' => $diagnosaPenyakit
        ];

        return view('backend.master.penyebab-penyakit.form',$params);


    }
    public  function  save(Request $request){

        $id = intval($request->input('id', 0));
        if($id){
            $data = RelationDiagnosaKlinis::find($id);
        }else{
            $data = new RelationDiagnosaKlinis();
        }


        $data->gejala_klinis_id= $request->id_gejala_klinis;
        $data->diagnosa_penyakit_id = $request->id_diagnosa_penyakit;

        $cek=RelationDiagnosaKlinis::where(['gejala_klinis_id' => $data->gejala_klinis_id, 'diagnosa_penyakit_id' => $data->diagnosa_penyakit_id])->first();
        if(!is_null($cek)){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Relasi sudah tersedia!</div>";
        }

        try{
            $data->save();
            return "
            <div class='alert alert-success'>Relasi berhasil disimpan!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Relasi gagal disimpan!</div>";
        }


    }
    public  function  delete(Request $request){

        $id = intval($request->input('id', 0));
        try{
            RelationDiagnosaKlinis::find($id)->delete();
            return "
            <div class='alert alert-success'>Relasi berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Relasi gagal dihapus!</div>";
        }
    }

}
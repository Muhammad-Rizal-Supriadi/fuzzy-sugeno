<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.46
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GejalaKlinis;
use App\Models\RelationKlinisFisik;
use App\Models\GejalaFisik;

class PenyebabKlinisController extends Controller
{
    public  function index(){

        $data = GejalaKlinis::all();
        $params = [
            'title' => 'Manajemen Hubungan Penyebab Penyakit',
            'data' => $data
        ];

        return view('backend.master.penyebab-klinis.index',$params);

    }

    public  function  view(Request $request){

        $idGejalaKlinis = $request->get('id');
        $data = RelationKlinisFisik::where(['gejala_klinis_id' => $idGejalaKlinis])->get();
        $params = [
            'gejalaKlinis' => GejalaKlinis::find($idGejalaKlinis),
            'title' => 'Manajemen Hubungan Penyebab Penyakit',
            'data' => $data
        ];
        return view('backend.master.penyebab-klinis.view',$params);

    }

    public  function form(Request $request){

        $idGejalaKlinis = $request->get('id_klinis');
        $id = $request->input('id');
        if($id){
            $data = RelationKlinisFisik::find($id);
        }else{
            $data = new RelationKlinisFisik();
        }

        $gejalaFisik = GejalaFisik::orderBy('id', 'ASC')->get();
        $gejalaKlinis = GejalaKlinis::find($idGejalaKlinis);
        $params = [
            'title' => 'Manajemen Hubungan Penyebab Penyakit',
            'data' => $data,
            'gejalaFisik' => $gejalaFisik,
            'gejalaKlinis' => $gejalaKlinis
        ];

        return view('backend.master.penyebab-klinis.form',$params);

    }
    public  function  save(Request $request){

        $id = intval($request->input('id', 0));
        if($id){
            $data = RelationKlinisFisik::find($id);
        }else{
            $data = new RelationKlinisFisik();
        }

        $data->gejala_fisik_id = $request->id_gejala_fisik;
        $data->gejala_klinis_id = $request->id_gejala_klinis;

        $cek=RelationKlinisFisik::where(['gejala_fisik_id' => $data->gejala_fisik_id, 'gejala_klinis_id' => $data->gejala_klinis_id])->first();
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
            RelationKlinisFisik::find($id)->delete();
            return "
            <div class='alert alert-success'>Relasi berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Relasi gagal dihapus!</div>";
        }
    }

}
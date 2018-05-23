<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.43
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use App\Models\DiagnosaPenyakit;
use Illuminate\Http\Request;

class DiagnosaPenyakitController extends Controller
{
    public  function index(){

        $data=DiagnosaPenyakit::all();
        $params=[
            'data'=>$data,
            'title'=>'Manajemen Diagnosa Penyakit'
        ];

        return view('backend.master.diagnosa-penyakit.index',$params);

    }

    public  function form(Request $request){

        $id = $request->input('id');
        if($id){
            $data = DiagnosaPenyakit::find($id);
        }else{
            $data = new DiagnosaPenyakit();
        }
        $params = [
            'title' => 'Manajemen Diagnosa Penyakit',
            'data' => $data
        ];
        return view('backend.master.diagnosa-penyakit.form',$params);
    }
    public  function  save(Request $request){
        $id = intval($request->input('id', 0));
        if($id){
            $data = DiagnosaPenyakit::find($id);
        }else{
            $data = new DiagnosaPenyakit();
            $cek=DiagnosaPenyakit::where(['nama_diagnosa_penyakit' => $data->nama_diagnosa_penyakit])->first();
            if(!is_null($cek)){
                return "<div class='alert alert-danger'>Terjadi kesalahan! Penyakit sudah tersedia!</div>";
            }

        }
        $data->nama_diagnosa_penyakit = $request->nama_diagnosa_penyakit;


        try{
            $data->save();
            return "
            <div class='alert alert-success'>Penyakit berhasil disimpan!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Penyakit gagal disimpan!</div>";
        }

    }
    public  function  delete(Request $request){

        $id = intval($request->input('id', 0));
        try{
            DiagnosaPenyakit::find($id)->delete();
            return "
            <div class='alert alert-success'>Penyakit berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Penyakit gagal dihapus!</div>";
        }

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.45
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GejalaFisik;

class GejalaFisikController extends Controller
{
    public  function index(){

        $data = GejalaFisik::all();
        $params = [
            'title' =>'Manajemen Gejala Fisik',
            'data' => $data
        ];

        return view('backend.master.gejala-fisik.index',$params);

    }

    public  function form(Request $request){
        $id = $request->input('id');

        if($id){
            $data = GejalaFisik::find($id);
        }else{
            $data = new GejalaFisik();
        }
        $params =[
            'title' =>'Manajemen Gejala Fisik',
            'data' =>$data
        ];
        return view('backend.master.gejala-fisik.form',$params);

    }
    public  function  save(Request $request){

        $id = intval($request->input('id',0));
        if($id){
            $data = GejalaFisik::find($id);
        }else{
            $data = new GejalaFisik();
            $cek = GejalaFisik::where(['nama_gejala_fisik'=>$data->nama_gejala_fisik])->first();
            if(!is_null($cek)){
                return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Fisik sudah tersedia!</div>";
            }
        }
        $data->nama_gejala_fisik = $request->nama_gejala_fisik;

        try{
            $data->save();
            return "
            <div class='alert alert-success'>Gejala Fisik berhasil disimpan!</div>
            <script> scrollToTop(); reload(1500); </script>";
        }catch(\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Fisik gagal disimpan!</div>";
        }

    }
    public  function  delete(Request $request){

        $id = intval($request->input('id',0));
        try{
            GejalaFisik::find($id)->delete();
            return "
            <div class='alert alert-success'>Gejala Fisik berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        }catch(\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Fisik gagal dihapus!</div>";
        }

    }

}
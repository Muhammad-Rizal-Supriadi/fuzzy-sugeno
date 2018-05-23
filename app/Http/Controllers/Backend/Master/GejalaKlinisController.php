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
use App\Models\GejalaKlinis;

class GejalaKlinisController extends Controller
{
    public  function index(){
        $data = GejalaKlinis::all();
        $params = [
            'title' =>'Manajemen Gejala Klinis',
            'data' => $data
        ];

        return view('backend.master.gejala-klinis.index',$params);

    }

    public  function form(Request $request){

        $id = $request->input('id');

        if($id){
            $data = GejalaKlinis::find($id);
        }else{
            $data = new GejalaKlinis();
        }
        $params =[
            'title' =>'Manajemen Gejala Klinis',
            'data' =>$data
        ];


        return view('backend.master.gejala-klinis.form',$params);


    }
    public  function  save(Request $request){
        $id = intval($request->input('id',0));
        if($id){
            $data = GejalaKlinis::find($id);
        }else{
            $data = new GejalaKlinis();
            $cek = GejalaKlinis::where(['nama_gejala_klinis'=>$data->nama_gejala_klinis])->first();
            if(!is_null($cek)){
                return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Klinis sudah tersedia!</div>";
            }
        }

        $data->nama_gejala_klinis = $request->nama_gejala_klinis;


        try{
            $data->save();
            return "
            <div class='alert alert-success'>Gejala Klinis berhasil disimpan!</div>
            <script> scrollToTop(); reload(1500); </script>";
        }catch(\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Klinis gagal disimpan!</div>";
        }

    }
    public  function  delete( Request $request){

        $id = intval($request->input('id',0));
        try{
            GejalaKlinis::find($id)->delete();
            return "
            <div class='alert alert-success'>Gejala Klinis berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        }catch(\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Gejala Klinis gagal dihapus!</div>";
        }
    }

}
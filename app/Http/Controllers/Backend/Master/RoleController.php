<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 08/05/18
 * Time: 18.23
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public  function index(){

        $data=Role::all();
        $params=[
            'data'=>$data,
            'title'=>'Manajemen Peran'
        ];

        return view('backend.master.role.index',$params);

    }

    public  function form(Request $request){

        $id = $request->input('id');
        if($id){
            $data = Role::find($id);
        }else{
            $data = new Role();
        }
        $params = [
            'title' => 'Manajemen Peran',
            'data' => $data
        ];
        return view('backend.master.role.form',$params);
    }
    public  function  save(Request $request){
        $id = intval($request->input('id', 0));
        if($id){
            $data = Role::find($id);
        }else{
            $data = new Role();
            $cek=Role::where(['nama_role' => $data->nama_role])->first();
            if(!is_null($cek)){
                return "<div class='alert alert-danger'>Terjadi kesalahan! Peran sudah tersedia!</div>";
            }

        }
        $data->nama_role = $request->nama_role;


        try{
            $data->save();
            return "
            <div class='alert alert-success'>Peran berhasil disimpan!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Peran gagal disimpan!</div>";
        }

    }
    public  function  delete(Request $request){

        $id = intval($request->input('id', 0));
        try{
            Role::find($id)->delete();
            return "
            <div class='alert alert-success'>Peran berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Peran gagal dihapus!</div>";
        }

    }

}
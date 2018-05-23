<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.47
 */

namespace App\Http\Controllers\Backend\Master;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public  function index(){

        $data=User::all();
        $params=[
            'data'=>$data,
            'title'=>'Manajemen Pengguna'
        ];

        return view('backend.master.users.index',$params);

    }

    public  function form(Request $request){

        $id = $request->input('id');
        if($id){
            $data = User::find($id);
        }else{
            $data = new User();
        }
        $roleOption=Role::all();
        $params = [
            'title' => 'Manajemen Pengguna',
            'data' => $data,
            'roleOption'=>$roleOption
        ];
        return view('backend.master.users.form',$params);
    }
    public  function  save(Request $request){
        $id = intval($request->input('id', 0));
        if($id){
            $data = User::find($id);
        }else{
            $data = new User();

        }
        $data->username = $request->username;
        $data->password=sha1($request->password);
        $data->role_id=$request->role_id;


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
            User::find($id)->delete();
            return "
            <div class='alert alert-success'>Peran berhasil dihapus!</div>
            <script> scrollToTop(); reload(1500); </script>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Peran gagal dihapus!</div>";
        }

    }

}
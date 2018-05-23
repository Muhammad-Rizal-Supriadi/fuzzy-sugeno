<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 06/04/18
 * Time: 21.18
 */

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{

    public function index(Request $request){
        if ($request->session()->exists('activeUser')) {
            return redirect('/backend');
        }
        return view('login.index');
    }

    public  function login(Request $request){
        $username=$request->input('username');
        $password=$request->input('password');

        $activeUser=User::where(['username'=>$username,'password'=>sha1($password)])->first();

        if(is_null($activeUser)){
            return "<div class='alert alert-danger'>Pengguna Tidak Ditemukan!</div>";

        }else{
            if($activeUser->password !=sha1($password)){
                return "<div class='alert alert-danger'>Username atau Password Salah!</div>";
            }else{
                $request->session()->put('activeUser', $activeUser);

                return "
            <div class='alert alert-success'>Login berhasil!</div>
            <script> scrollToTop(); reload(1000); </script>";
            }
        }


    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }


}
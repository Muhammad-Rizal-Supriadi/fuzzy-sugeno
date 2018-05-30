<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 30/05/18
 * Time: 11.52
 */

namespace App\Http\Controllers\Backend\Fuzzy;


use App\Fuzzy\Fuzzy;
use App\Http\Controllers\Controller;
use App\Models\Hight;
use App\Models\Weight;
use Illuminate\Http\Request;

class FuzzyController extends Controller
{


    public function index(){

        $params = [
            'title' => 'Fuzzy Kesehatan',
        ];

        return view('backend.fuzzy.index', $params);
    }

    public function process(Request $request){
        $hight = floatval($request->hight);
        $weight = floatval($request->weight);
        $fuzzy= new Fuzzy($hight,$weight);
        $params=[
            'fuzzy'=>$fuzzy->analyze()
        ];

        return view('backend.fuzzy.result', $params);
    }

}
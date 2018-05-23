<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 08/05/18
 * Time: 09.52
 */

namespace App\Http\Controllers\Backend\Pakar;


use App\Http\Controllers\Controller;
use App\Models\DiagnosaPenyakit;
use App\Models\GejalaFisik;
use Illuminate\Http\Request;

class SistemPakarController extends  Controller
{

    public  function index(){

        $data = GejalaFisik::all();
        $params = [
            'title' =>'Sistem Pakar',
            'data' => $data
        ];
        return view('backend.pakar.index',$params);

    }

    public  function  proses(Request $request){
        $kesimpulan = [];
        $kesimpulanAkhir = [];
        $response = $request->input('response');
        $treshold = $request->input('treshold');
        if($treshold >=100){
            return "<div class='alert alert-danger'>Terjadi kesalahan! Treshold melebihi 100</div>";
        }
        $diagnosa = [];
        foreach ($response as $no => $item){
            if(!is_null($item) && $item != ""){
                $diagnosa[$item] = $item;
            }
        }

        $dataDiagnosa = DiagnosaPenyakit::all();
        foreach ($dataDiagnosa as $num => $item){
            $dataRelationKlinis=$item->getRelationDiagnosa;
            $totalKlinis=count($dataRelationKlinis);
            //$nilaiKlinis=0;
            $scoring=[];
            foreach ($dataRelationKlinis as $key => $klinis){
                $dataRelationFisik=$klinis->getGejalaKlinis->getRelationFisik;
                $totalFisik=count($dataRelationFisik);
                $scoringFisik=0;
                foreach ($dataRelationFisik as $value => $fisik){
                    if(isset($diagnosa[$fisik->gejala_fisik_id])){
                        $scoringFisik +=(100/$totalFisik);
                    }
                }
                $nilaiKlinis=$scoringFisik * (100/$totalKlinis)/100;
                $scoring[]=$nilaiKlinis;
            }
            $tmpNilaiAkhir=0;
            foreach ($scoring as $index =>$score){

                $tmpNilaiAkhir+=$score;
            }

            $kesimpulan[] = [
                'diagnosa' => $item,
                'nilai' => $tmpNilaiAkhir
            ];

        }


        foreach ($kesimpulan as $item)
        {
            if($item['nilai'] >=floatval($treshold)){
                $kesimpulanAkhir[]=[
                    'diagnosa'=>$item['diagnosa']->nama_diagnosa_penyakit,
                    'nilai'=>$item['nilai']

                ];
            }
        }

        $params=[
            'kesimpulan'=>$kesimpulanAkhir
        ];

        return view('backend.pakar.result',$params);

    }

}
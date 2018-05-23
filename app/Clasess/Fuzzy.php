<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 23/05/18
 * Time: 06.45
 */

namespace App\Clasess;
use App\Models\Kriteria;
use App\Models\Berat;
use App\Models\Tinggi;

class Fuzzy
{
    private $dataTinggi;
    private $dataBerat;
    private $dataKriteria;


    public function __construct()
    {
        $this->dataTinggi=Tinggi::all();
        $this->dataBerat=Berat::all();
        $this->dataKriteria=Kriteria::all();
    }

    public function fuzzy($tinggi,$berat){
        $dataTinggi=$this->dataTinggi;
        $degreeStatusTinggi=[];
        $degreeTinggi=
        $degreeStatusBerat=[];

        for ($i=0;$i<config($dataTinggi);$i++){
            if($tinggi>=$dataTinggi[$i]['min'] && $tinggi<=$dataTinggi[$i]['max']){
                $degreeStatusTinggi[0]=$dataTinggi[$i]['nama'];
                $degreeStatusTinggi[1]=$dataTinggi[$i+1]['nama'];



            }else{

            }
        }


    }



}
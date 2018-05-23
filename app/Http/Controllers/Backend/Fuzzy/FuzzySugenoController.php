<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 23/05/18
 * Time: 06.44
 */

namespace App\Http\Controllers\Backend\Fuzzy;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FuzzySugenoController extends Controller
{
    private $rangeTinggi;
    private $statusTinggi;
    private $statusBerat;
    private $rangeBerat;
    private $rules;
    private $degreeStatusTinggi=array();
    private $degreeTinggi=array();
    private $degreeStatusBerat=array();
    private $degreeBerat=array();
    private $fuzzyValue=array();
    private $fuzzyStatus=array();
    private $maxValue=0;
    private $maxStatus=null;
    private $sugenoValue;
    private $cripsIndex;


    public function __construct()
    {
        $this->rangeTinggi=[0, 115, 120, 140, 145, 160, 165, 180, 185, 200];
        $this->statusTinggi=["Sangat Pendek", "Pendek", "Sedang", "Tinggi", "Sangat Tinggi"];
        $this->rangeBerat=[0, 40, 45, 50, 55, 60, 65, 80, 85,100];
        $this->statusBerat=["Sangat Kurus", "Kurus", "Biasa", "Berat", "Sangat Berat"];
        $this->rules=[
            ["Sangat Sehat","Sehat","Agak Sehat","Tidak Sehat","Tidak Sehat"],
            ["Sehat","Sangat Sehat", "Sehat","Agak Sehat","Tidak Sehat"],
            ["Agak Sehat","Sangat Sehat", "Sangat Sehat", "Agak Sehat","Tidak Sehat"],
            ["Tidak Sehat","Sehat","Sangat Sehat", "Sehat","Tidak Sehat"],
            ["Tidak Sehat","Agak Sehat","Sangat Sehat", "Sehat","Agak Sehat"]
        ];
        $this->sugenoValue=[
            "Tidak Sehat"=>0.2,
            'Agak Sehat'=>0.4,
            'Sehat'=>0.6,
            'Sangat Sehat'=>0.8
        ];

    }

    public  function index(){

        $params = [
            'title' =>'Fuzzy Kesehatan',
        ];
        return view('backend.fuzzy.index',$params);

    }

    public function proses(Request $request){
        $tinggi=floatval($request->tinggi);
        $berat=floatval($request->berat);
        $dataTinggi=$this->rangeTinggi;
        $statusTinggi=$this->statusTinggi;
        $dataBerat=$this->rangeBerat;
        $statusBerat=$this->statusBerat;

        for($i=0;$i<count($dataTinggi);$i++){
            if($tinggi>=floatval($dataTinggi[$i])){
                $this->degreeStatusTinggi[0]=$statusTinggi[$i/2];
                $this->degreeStatusTinggi[1]=$statusTinggi[$i/2+1];
                $this->degreeTinggi[0]=($dataTinggi[$i+1]-$tinggi)/($dataTinggi[$i+1]-$dataTinggi[$i]);
                $this->degreeTinggi[1]=($tinggi-$dataTinggi[$i])/($dataTinggi[$i+1]-$dataTinggi[$i]);
            }
        }

        for($i=0;$i<count($dataBerat);$i++){
            if($berat>=floatval($dataBerat[$i])){
                $this->degreeStatusBerat[0]=$statusBerat[$i/2];
                $this->degreeStatusBerat[1]=$statusBerat[$i/2+1];
                $this->degreeBerat[0]=($dataBerat[$i+1]-$berat)/($dataBerat[$i+1]-$dataBerat[$i]);
                $this->degreeBerat[1]=($berat-$dataBerat[$i])/($dataBerat[$i+1]-$dataBerat[$i]);
            }
        }
        $this->deFuzzificate();
        $this->findMethod();
        $this->findSugenoMethod();
        $this->showFuzzyValue();
    }

    private function deFuzzificate(){
        $x=0;
        for ($i=0;$i<count($this->degreeTinggi);$i++){
            for($j=0;$j<count($this->degreeBerat);$j++){
                if($this->degreeTinggi[$i]< $this->degreeBerat[$j]){
                    $this->fuzzyValue[$x]=$this->degreeTinggi[$i];
                }else{
                    $this->fuzzyValue[$x]=$this->degreeBerat[$j];
                }
                $this->fuzzyStatus[$x]=$this->rules[$this->converToString($this->statusTinggi,$this->degreeStatusTinggi[$i])][$this->converToString($this->statusBerat,$this->degreeStatusBerat[$j])];
                $x++;
            }
        }
    }

    private function converToString($string,$item){
        for ($i = 0;$i < count($string); $i++) {
            if($item ==$string[$i])  return $i;
        }
        return -1;

    }

    private function findMethod(){
        for ($i = 0; $i <count($this->fuzzyValue); $i++) {
            if ($this->fuzzyValue[$i] > $this->maxValue) {
                $this->maxValue    = $this->fuzzyValue[$i];
                $this->maxStatus   = $this->fuzzyStatus[$i];
            }
            echo "<p>".$this->fuzzyStatus[$i] .":". $this->fuzzyValue[$i]."</p>";
        }
    }

    private function findSugenoMethod(){
        $f = 0;
        for ($i = 0; $i <count($this->fuzzyValue); $i++) {
            $this->cripsIndex += $this->fuzzyValue[$i] * $this->sugenoValue[$this->fuzzyStatus[$i]];
            echo "<p>Item :".$this->fuzzyValue[$i]."|".$this->sugenoValue[$this->fuzzyStatus[$i]]."</p>";
            $f += $this->fuzzyValue[$i];
        }
        $this->cripsIndex /= $f;
        echo "Crips Index :".$this->cripsIndex;
    }

    private function showFuzzyValue(){
        echo "<p>Result :</p>";
        echo "<p>Status    :".$this->maxStatus."</p>";
        echo "<p>Value     :".$this->maxValue."</p>";
    }


}
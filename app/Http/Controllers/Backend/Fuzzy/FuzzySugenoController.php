<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 23/05/18
 * Time: 06.44.
 */

namespace App\Http\Controllers\Backend\Fuzzy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuzzySugenoController extends Controller
{
    private $hightRange;
    private $hightStatus;
    private $weightRange;
    private $weightStatus;
    private $rules;
    private $hightStatusDegree = array();
    private $hightDegree = array();
    private $weightStatusDegree = array();
    private $weightDegree = array();
    private $fuzzyValue = array();
    private $fuzzyStatus = array();
    private $maxValue = 0;
    private $maxStatus = null;
    private $sugenoValue;
    private $cripsIndex;

    public function __construct()
    {
        $this->hightRange = [0, 115, 120, 140, 145, 160, 165, 180, 185, 200];
        $this->hightStatus = ['Sangat Pendek', 'Pendek', 'Sedang', 'Tinggi', 'Sangat Tinggi'];
        $this->weightRange = [0, 40, 45, 50, 55, 60, 65, 80, 85, 100];
        $this->weightStatus = ['Sangat Kurus', 'Kurus', 'Biasa', 'Berat', 'Sangat Berat'];
        $this->rules = [
            ['Sangat Sehat', 'Sehat', 'Agak Sehat', 'Tidak Sehat', 'Tidak Sehat'],
            ['Sehat', 'Sangat Sehat', 'Sehat', 'Agak Sehat', 'Tidak Sehat'],
            ['Agak Sehat', 'Sangat Sehat', 'Sangat Sehat', 'Agak Sehat', 'Tidak Sehat'],
            ['Tidak Sehat', 'Sehat', 'Sangat Sehat', 'Sehat', 'Tidak Sehat'],
            ['Tidak Sehat', 'Agak Sehat', 'Sangat Sehat', 'Sehat', 'Agak Sehat'],
        ];
        $this->sugenoValue = [
            'Tidak Sehat' => 0.2,
            'Agak Sehat' => 0.4,
            'Sehat' => 0.6,
            'Sangat Sehat' => 0.8,
        ];
    }

    public function index()
    {
        $params = [
            'title' => 'Fuzzy Kesehatan',
        ];

        return view('backend.fuzzy.index', $params);
    }

    public function process(Request $request)
    {
        $x = 0;
        $value = 0;
        $hight = floatval($request->hight);
        $weight = floatval($request->weight);
        $hightData = $this->hightRange;
        $hightStatus = $this->hightStatus;
        $weightData = $this->weightRange;
        $weightStatus = $this->weightStatus;

        // dd($hightData);
        for ($i = 0; $i < count($hightData); ++$i) {
             if ($hight > floatval($hightData[$i])) {
                 try {
                     $this->hightStatusDegree[0] = $hightStatus[$i / 2];
                     $this->hightStatusDegree[1] = $hightStatus[$i / 2 + 1];
                     $this->hightDegree[0] = ($hightData[$i + 1] - $hight) / ($hightData[$i + 1] - $hightData[$i]);
                     $this->hightDegree[1] = ($hight - $hightData[$i]) / ($hightData[$i + 1] - $hightData[$i]);
                 } catch (\Exception $e) {
                     return "<div class='alert alert-danger'>Terjadi kesalahan! Tinggi melebihi range</div>";
                 }
             }
        }

        for ($i = 0; $i < count($weightData); ++$i) {
             if ($weight > floatval($weightData[$i])) {
                 try {
                     $this->weightStatusDegree[0] = $weightStatus[$i / 2];
                     $this->weightStatusDegree[1] = $weightStatus[$i / 2 + 1];
                     $this->weightDegree[0] = ($weightData[$i + 1] - $weight) / ($weightData[$i + 1] - $weightData[$i]);
                     $this->weightDegree[1] = ($weight - $weightData[$i]) / ($weightData[$i + 1] - $weightData[$i]);
                 } catch (\Exception $e) {
                     return "<div class='alert alert-danger'>Terjadi kesalahan! Berat melebihi range</div>";
                 }
             }
        }

        //	Rules Evaluation
        for ($i = 0; $i < count($this->hightDegree); ++$i) {
            for ($j = 0; $j < count($this->weightDegree); ++$j) {
                if ($this->hightDegree[$i] < $this->weightDegree[$j]) {
                    $this->fuzzyValue[$x] = $this->hightDegree[$i];
                } else {
                    $this->fuzzyValue[$x] = $this->weightDegree[$j];
                }
                $this->fuzzyStatus[$x] = $this->rules[$this->convertToString($this->hightStatus, $this->hightStatusDegree[$i])][$this->convertToString($this->weightStatus, $this->weightStatusDegree[$j])];
                ++$x;
            }
        }

        //Rules Evaluation (part 2)
        $paramsFindMethod = [];
        for ($i = 0; $i < count($this->fuzzyValue); ++$i) {
            if ($this->fuzzyValue[$i] > $this->maxValue) {
                $this->maxValue = $this->fuzzyValue[$i];
                $this->maxStatus = $this->fuzzyStatus[$i];
            }
            $paramsFindMethod[] = [
                'fuzzy_status' => $this->fuzzyStatus[$i],
                'fuzzy_value' => $this->fuzzyValue[$i],
            ];
        }

        //Defuzzification
        $paramsSugenoMethod = [];
        for ($i = 0; $i < count($this->fuzzyValue); ++$i) {
            $this->cripsIndex += $this->fuzzyValue[$i] * $this->sugenoValue[$this->fuzzyStatus[$i]];
            $paramsSugenoMethod[] = [
                'fuzzy_value' => $this->fuzzyValue[$i],
                'sugeno_value' => $this->sugenoValue[$this->fuzzyStatus[$i]],
            ];
            $value += $this->fuzzyValue[$i];
        }

        $paramsResult = [
            'max_status' => $this->maxStatus,
            'max_value' => $this->maxValue,
        ];

        $params = [
            'findMethod' => $paramsFindMethod,
            'findSugenoMethod' => $paramsSugenoMethod,
            'cripsIndex' => $this->cripsIndex /= $value,
            'result' => $paramsResult,
        ];

        return view('backend.fuzzy.result', $params);
    }

    private function convertToString($string, $item)
    {
        for ($i = 0; $i < count($string); ++$i) {
            if ($item == $string[$i]) {
                return $i;
            }
        }

        return -1;
    }


}

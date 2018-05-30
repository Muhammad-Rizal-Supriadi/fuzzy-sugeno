<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 30/05/18
 * Time: 11.57.
 */

namespace App\Fuzzy;

use App\Models\Hight;
use App\Models\Weight;

class Fuzzy
{
    private $rules = [
        ['Sangat Sehat', 'Sehat', 'Agak Sehat', 'Tidak Sehat', 'Tidak Sehat'],
        ['Sehat', 'Sangat Sehat', 'Sehat', 'Agak Sehat', 'Tidak Sehat'],
        ['Agak Sehat', 'Sangat Sehat', 'Sangat Sehat', 'Agak Sehat', 'Tidak Sehat'],
        ['Tidak Sehat', 'Sehat', 'Sangat Sehat', 'Sehat', 'Tidak Sehat'],
        ['Tidak Sehat', 'Agak Sehat', 'Sangat Sehat', 'Sehat', 'Agak Sehat'],
    ];
    private $sugenoValue = [
        'Tidak Sehat' => 0.2,
        'Agak Sehat' => 0.4,
        'Sehat' => 0.6,
        'Sangat Sehat' => 0.8,
    ];
    private $hight;
    private $weight;
    private $hightStatusDegree = array();
    private $hightDegree = array();
    private $weightStatusDegree = array();
    private $weightDegree = array();
    private $fuzzyValue = array();
    private $fuzzyStatus = array();
    private $maxValue;
    private $maxStatus;
    private $cripsIndex;
    private $fuzzyOne;

    public function __construct($hight, $weight)
    {
        $this->hight = new Hight($hight);
        $this->weight = new Weight($weight);
    }

    public function analyze()
    {
        if ($this->hight->isExactValueHight() && $this->weight->isExactValueWeight()) {
            $paramsCheck = '';
            for ($i = 0; $i < count($this->rules); ++$i) {
                for ($j = 0; $j < count($this->rules); ++$j) {
                    $paramsCheck = $this->checkExactValue($i, $j);
                }
            }
            $params = [
                'code' => 1,
                'status' => $paramsCheck,
                'cripsIndex' => $this->sugenoValue[$paramsCheck],
            ];
        } else {
            for ($i = 0; $i < count($this->hight->getRanges()); ++$i) {
                if ($this->hight->getXHight() > floatval($this->hight->getRanges()[$i])) {
                    $this->hightStatusDegree[0] = $this->hight->getStatus()[$i / 2];
                    $this->hightStatusDegree[1] = $this->hight->getStatus()[$i / 2 + 1];
                    $this->hightDegree[0] = ($this->hight->getRanges()[$i + 1] - $this->hight->getXHight()) / ($this->hight->getRanges()[$i + 1] - $this->hight->getRanges()[$i]);
                    $this->hightDegree[1] = ($this->hight->getXHight() - $this->hight->getRanges()[$i]) / ($this->hight->getRanges()[$i + 1] - $this->hight->getRanges()[$i]);
                }
            }

            for ($i = 0; $i < count($this->weight->getRanges()); ++$i) {
                if ($this->weight->getXWeight() > floatval($this->weight->getRanges()[$i])) {
                    $this->weightStatusDegree[0] = $this->weight->getStatus()[$i / 2];
                    $this->weightStatusDegree[1] = $this->weight->getStatus()[$i / 2 + 1];
                    $this->weightDegree[0] = ($this->weight->getRanges()[$i + 1] - $this->weight->getXWeight()) / ($this->weight->getRanges()[$i + 1] - $this->weight->getRanges()[$i]);
                    $this->weightDegree[1] = ($this->weight->getXWeight() - $this->weight->getRanges()[$i]) / ($this->weight->getRanges()[$i + 1] - $this->weight->getRanges()[$i]);
                }
            }

            $x = 0;
            for ($i = 0; $i < count($this->hightDegree); ++$i) {
                for ($j = 0; $j < count($this->weightDegree); ++$j) {
                    if ($this->hightDegree[$i] < $this->weightDegree[$j]) {
                        $this->fuzzyValue[$x] = $this->hightDegree[$i];
                    } else {
                        $this->fuzzyValue[$x] = $this->weightDegree[$j];
                    }
                    $this->fuzzyStatus[$x] = $this->rules[$this->convertToString($this->hight->getStatus(), $this->hightStatusDegree[$i])][$this->convertToString($this->weight->getStatus(), $this->weightStatusDegree[$j])];
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
            $value = 0;
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
                'code' => 2,
                'findMethod' => $paramsFindMethod,
                'findSugenoMethod' => $paramsSugenoMethod,
                'cripsIndex' => $this->cripsIndex /= $value,
                'result' => $paramsResult,
            ];
        }

        return $params;
    }

    public function checkExactValue($i, $j)
    {
        if (($this->hight->getXStatusIndex() == $i && ($this->weight->getXStatusIndex() == $j))) {
            $this->fuzzyOne = $this->rules[$i][$j];
        }

        return $this->fuzzyOne;
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

<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 30/05/18
 * Time: 11.41
 */

namespace App\Models;


class Hight
{

    private $ranges  = [0, 115, 120, 140, 145, 160, 165, 180, 185];
    private $status  = ["Sangat Pendek", "Pendek", "Sedang", "Tinggi", "Sangat Tinggi"];

    private $xHight;
    private $xStatusExact = null;
    private $xStatusIndex;

    /**
     * Hight constructor.
     * @param $xHight
     */
    public function __construct($xHight)
    {
        $this->xHight = $xHight;
    }

    /**
     * @return array
     */
    public function getRanges()
    {
        return $this->ranges;
    }

    /**
     * @param array $ranges
     */
    public function setRanges($ranges)
    {
        $this->ranges = $ranges;
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getXHight()
    {
        return $this->xHight;
    }

    /**
     * @param mixed $xHight
     */
    public function setXHight($xHight)
    {
        $this->xHight = $xHight;
    }

    /**
     * @return null
     */
    public function getXStatusExact()
    {
        return $this->xStatusExact;
    }

    /**
     * @param null $xStatusExact
     */
    public function setXStatusExact($xStatusExact)
    {
        $this->xStatusExact = $xStatusExact;
    }

    /**
     * @return mixed
     */
    public function getXStatusIndex()
    {
        return $this->xStatusIndex;
    }

    /**
     * @param mixed $xStatusIndex
     */
    public function setXStatusIndex($xStatusIndex)
    {
        $this->xStatusIndex = $xStatusIndex;
    }

    public function isExactValueHight()
    {
        $isExact = false;
        for ($i = 0; $i < count($this->ranges); $i++) {
            if (($i % 2 == 0) && ($this->getXHight() > $this->ranges[$i]) && ($this->getXHight() <= $this->ranges[$i + 1])) {
                $isExact = true;
                $this->xStatusExact = $this->status[$i / 2];
                $this->xStatusIndex = $i / 2;
            }
        }
        return $isExact;
    }


}
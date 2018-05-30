<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 30/05/18
 * Time: 11.41
 */

namespace App\Models;


class Weight
{

    private $ranges  = [0, 40, 45, 50, 55, 60, 65, 80, 85];
    private $status  = ["Sangat Kurus", "Kurus", "Biasa", "Berat", "Sangat Berat"];

    private $xWeight;
    private $xStatusExact = null;
    public $xStatusIndex;

    /**
     * Weight constructor.
     */
    public function __construct($xWeight)
    {
        $this->xWeight=$xWeight;

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
    public function getXWeight()
    {
        return $this->xWeight;
    }

    /**
     * @param mixed $xWeight
     */
    public function setXWeight($xWeight)
    {
        $this->xWeight = $xWeight;
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

    public function isExactValueWeight()
    {
        $isExact = false;
        for ($i = 0; $i < count($this->ranges); ++$i) {
            if (($i % 2 == 0) && ($this->getXWeight() > $this->ranges[$i]) && ($this->getXWeight() <= $this->ranges[$i + 1])) {
                $isExact = true;
                $this->xStatusExact = $this->status[$i/2];
                $this->xStatusIndex = $i / 2;
            }
        }
        return $isExact;
    }



}

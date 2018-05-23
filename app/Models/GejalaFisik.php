<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.35
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GejalaFisik extends  Model
{
    protected $table = 'gejala_fisik';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
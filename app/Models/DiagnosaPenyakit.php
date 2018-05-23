<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DiagnosaPenyakit extends Model
{
    protected $table = 'diagnosa_penyakit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getRelationDiagnosa()
    {
        return $this->hasMany('App\Models\RelationDiagnosaKlinis', 'diagnosa_penyakit_id', 'id');
    }

}
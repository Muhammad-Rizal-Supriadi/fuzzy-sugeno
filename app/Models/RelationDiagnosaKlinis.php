<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.38
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RelationDiagnosaKlinis extends Model
{
    protected $table = 'relation_diagnosa_klinis';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getGejalaKlinis()
    {
        return $this->hasOne('App\Models\GejalaKlinis', 'id', 'gejala_klinis_id');
    }

    public function getDiagnosaPenyakit()
    {
        return $this->hasOne('App\Models\DiagnosaPenyakit', 'id', 'diagnosa_penyakit_id');
    }


}
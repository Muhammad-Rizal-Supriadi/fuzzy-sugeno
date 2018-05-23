<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RelationKlinisFisik extends Model
{
    protected $table = 'relation_klinik_fisik';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getGejalaFisik()
    {
        return $this->hasOne('App\Models\GejalaFisik', 'id', 'gejala_fisik_id');
    }

    public function getGejalaKlinis()
    {
        return $this->hasOne('App\Models\GejalaKlinis', 'id', 'gejala_klinis_id');
    }

}
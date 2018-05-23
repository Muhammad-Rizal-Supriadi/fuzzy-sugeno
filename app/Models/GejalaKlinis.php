<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GejalaKlinis extends Model
{
    protected $table = 'gejala_klinis';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function getRelationFisik()
    {
        return $this->hasMany('App\Models\RelationKlinisFisik', 'gejala_klinis_id', 'id');
    }
}
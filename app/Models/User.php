<?php
/**
 * Created by PhpStorm.
 * User: mfarid
 * Date: 07/05/18
 * Time: 20.35
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getRole(){
        return $this->hasOne('App\Models\Role','id','role_id');
    }

}